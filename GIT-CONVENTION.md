# Repository Naming Conventions

In this repository, we follow a set of naming conventions for commits, branches, and pull requests to ensure consistency, traceability, and collaboration efficiency.

## Commits

### 1. Commit Messages

- **Use Descriptive Messages**: Commit messages should be clear and descriptive, summarizing the changes made in the commit. A good format is:

For example:
- `Fix: Resolve issue with user authentication`
- `Feature: Implement user profile settings`

- **Separate Subject and Body**: If needed, separate the subject line from the body with a blank line. The body should provide more context and details about the changes made.

- **Use Imperative Verbs**: Start the subject line with an imperative verb (e.g., Fix, Add, Update, Refactor) that conveys what the commit does.

- **Reference Issue Numbers**: If your commit relates to a specific issue or task, reference it in the commit message using the `#<issue_number>` format. 

For example: 
- `Fix: Resolve issue #123`

### 2. ![Gitmoji](https://gitmoji.dev/) (Optional)

- **Include a gitmoji (if relevant)**: Optionally, you can include a gitmoji at the begining of the message to indicate the module or component affected by the commit.

For example:
- `🐛 Fix: Resolve issue with user authentication`
- `✨ Feature: Implement user profile settings`

## Branches

### 1. Branch Names

- **Use Hyphen Separators**: Branch names should be in lowercase and use hyphens to separate words. 

For example: 
- `feature-login-page`
- `bugfix-user-profile`

- **Be Descriptive**: Branch names should be descriptive of the work being done in the branch. Avoid generic names like `fix` or `update`.

- **Include Issue or Task Number**: Include the related issue or task number in the branch name, if applicable, to link it to a specific piece of work. 

For example: 
- `bugfix-user-profile-123`

## Pull Requests (PRs)

### 1. PR Titles

- **Use Descriptive Titles**: PR titles should provide a concise and clear summary of the changes in the PR. Follow a similar format to commit messages, starting with an imperative verb.

- **Reference Related Issue**: If the PR is related to a specific issue or task, reference it in the PR title using the `#<issue_number>` format. 

For example: 
- `Fix: Resolve issue #123`

### 2. PR Descriptions

- **Provide Context**: In the PR description, provide additional context, such as why the changes were made and any potential impact.

- **Link to Issues**: Link to related issues or tasks in the PR description using the `#<issue_number>` format.

By adhering to these naming conventions, we aim to maintain a well-organized and collaborative development process. Clear and descriptive commit messages, branch names, and PR titles will help everyone on the team understand and review code changes efficiently.
