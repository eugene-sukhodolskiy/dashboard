# Dashboard
It is simple info panel for display base info about your projects on your pc.

## How to install
You can install Dashboard like any site on PHP, so for installing need only Apache server with PHP. Database don't need. 

## Hotkey map
- `ctrl + shift + f` For set focus on search field
- `ctrl + q` For close search results or close project description or close something else
- `ctrl + i` For watching project colors
- `ctrl + enter` Open selected project in new tab
- `enter` For open description of selected project
And you can navigations on projects with used keyboard arrows.

## project.json file

	{
		"name": "Display name",
		"ver": "1.0",
		"author": "Author full name",
		"release_url": "https://link-on-release.host",
		"git_url": "https://github.com/someuser/reponame",
		"tags": ["tag1", "tag2", "tag3"],
		"status": "open||close",
		"type": "web||console||app||docs||other",
		"project_color": "#f60",
		"favicon": null||"https://link-on-release.local/favicon.png",
		"main_lang": "php",
		"description": "This is description of project"
	}

If some project based in side from folders with projects, you can create empty folder with file project.json and write inside `{ "path_to_project": "path/to/other/folder" }`

#### Console app for easy create project.json file
You can use console script `php dashboard/init-project.php your-project.json` for easy create project.json

## How to use search field
- You can text tags with split comma for filtered projects by tags. Example `laravel, vue, open source`
- Write name of project for searching project name
- ~~You can text `open` or `close` for filtered project list by `status`~~