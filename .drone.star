def main(ctx):
  return {
    "kind": "pipeline",
    "name": "archivr_CI_CD",
    "steps": CD(ctx)
  }

def archivr_tests(ctx):
  return {
    "name": "archivr_tests",
    "image": "php:8.1-cli",
    "commands": [
      "chmod +x phpunit",
      "pecl install xdebug",
      "PHP_INI_PATH=$(php --ini | grep 'Loaded Configuration File' | awk '{printf(\"%s\",$4)}')",
      "echo zend_extension=xdebug.so >> $PHP_INI_PATH",
      "echo xdebug.mode=coverage >> $PHP_INI_PATH",
      "service php8.1-cli restart",
      "./phpunit",
    ]
  }

def archivr_code_inspection(ctx):
  return {
    "name": "archivr_code_inspection",
    "image": "php:8.1-cli",
    "environment": {
      "SONAR_TOKEN": {
        "from_secret": "SONAR_TOKEN"
      }
    },
    "commands": [
      "apt-get update && apt-get install -y curl unzip",
      "export SONAR_SCANNER_VERSION=4.7.0.2747",
      "export SONAR_SCANNER_HOME=$HOME/.sonar/sonar-scanner-$SONAR_SCANNER_VERSION-linux",
      "curl --create-dirs -sSLo $HOME/.sonar/sonar-scanner.zip https://binaries.sonarsource.com/Distribution/sonar-scanner-cli/sonar-scanner-cli-$SONAR_SCANNER_VERSION-linux.zip",
      "unzip -o $HOME/.sonar/sonar-scanner.zip -d $HOME/.sonar/",
      "export PATH=$SONAR_SCANNER_HOME/bin:$PATH",
      "export SONAR_SCANNER_OPTS='-server'",
      "cd src",
      "sonar-scanner -Dsonar.projectKey=archivr -Dsonar.host.url=https://codefirst.iut.uca.fr/sonar/ -Dsonar.login=$${SONAR_TOKEN} -Dsonar.php.coverage.reportPaths=../reports.xml",
    ]
  }

def archivr_image(ctx):
  return {
    "name": "archivr_image",
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
    "depends_on": ["archivr_code_inspection"]
  }

def archivr_active_container(ctx):
  return {
    "name": "archivr_active_container",
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
    "depends_on": ["archivr_image"]
  }

def CD(ctx):
  out = []
  if ctx.build.message.find("[no_ci]") != -1 or ctx.build.message.find("README.md") != -1: 
    return out

  if ctx.build.message.find("[sonar]") != -1:
      out.append(archivr_tests(ctx))
      out.append(archivr_code_inspection(ctx))
      return out

  if ctx.build.message.find("[tests]") != -1 or ctx.build.message.find("[test]") != -1:
    out.append(archivr_tests(ctx))
    return out

  if ctx.build.branch == "master" or ctx.build.message.find("[force_ci]") != -1:
    out.append(archivr_tests(ctx))
    out.append(archivr_code_inspection(ctx))
    out.append(archivr_image(ctx))
    out.append(archivr_active_container(ctx))
    return out