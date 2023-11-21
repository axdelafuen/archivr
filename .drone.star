def main(ctx):
  return {
    "kind": "pipeline",
    "name": "CD",
    "steps": CD(ctx)
  }

def archivr_image(ctx):
  return {
    "name": "archivr-image",
    "image": "plugins/docker",
    "settings": {
      "dockerfile": "./Dockerfile",
      "context": "./",
      "registry": "hub.codefirst.iut.uca.fr",
      "repo": "hub.codefirst.iut.uca.fr/archivr/archivr",
      "username": {
        "from_secret": "secret-registry-username",
      },
      "password": {
        "from_secret": "secret-registry-password"
      },
    },
  }

def archivr_active_container(ctx):
  return {
    "name": "archivr-active-container",
    "image": "hub.codefirst.iut.uca.fr/thomas.bellembois/codefirst-dockerproxy-clientdrone:latest",
    "needs": "archivr-image",
    "environment": {
      "IMAGENAME": "hub.codefirst.iut.uca.fr/archivr/archivr:latest",
      "CONTAINERNAME": "archivr",
      "COMMAND": "create",
      "OVERWRITE": "true",
      "ADMINS": "axelde_la_fuente,vincentastolfi,aurianjault",
      "CODEFIRST_CLIENTDRONE_ENV_DEPLOYED": "deployed",
    },
  }

def CD(ctx):
  out = []
  if ctx.build.message.find("[no_ci]") != -1 or ctx.build.message.find("README.md") != -1: 
    return out

  if ctx.build.branch == "master" or ctx.build.message.find("[FORCE_CI]") != -1:
    out.append(archivr_image(ctx))
    out.append(archivr_active_container(ctx))