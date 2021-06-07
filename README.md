# SecretNVP

SecretNVP is a simple application that stores and retrieves name-value-pairs. It was intended as "homework" to demonstrate knowledge in the domain. Criticisms are welcome!

This was implemented with a monolith that acts as a backend application for an endpoint. Here are the tech stack involved: 

### Tech Stack
* Virtualization: docker
* Application environment: unix + php environment running on a docker container 
* Database: mongodb on a docker
* Development Framework: Laravel 8
* Language: PHP
* App dependencies: 
	* jenssegers/laravel-mongodb - mongodb driver for laravel
* Codebase repository: github
* CI/CD: github actions
* Code analysis: Sonarcloud

## Guides

**Installation**

1.  Install git, docker, and docker-compose in your machine.
2.  Clone the repository.
3.  Create and populate a ".env" file. (Or you can copy the existing sample). This will be your local configuration.
4.  Run a Mongodb instance on docker. ( Reference: [https://hub.docker.com/_/mongo](https://hub.docker.com/_/mongo))
5.  We will be utilizing Laravel's sail as it is a very cool tool to use. Go to the project's root directory.
6.  run "vendor/bin/sail up -d" and wait till everything finishes.
7.  Check your host to see if there are errors reflected. This will depend on how you configured your installation, but it may be localhost with a designated port.
8.  Setup the database, by creating a database with your configured database name.
9.  Seed the database with "vendor/bin/sail artisan db:seed" command
10.  Please note that seeding the data will have a record with the key "FOO", which we will used for initial tests

**Using the app**

You can use curl or any REST API tools available. Here are the endpoints with examples.

* POST -> **{your-host}/api/object**
	* Creates a record
	* Expected input for the request body:
		* key - alpha numeric
		* value - alpha numeric
* GET -> **{your-host}/api/object/get-all-records**
	* Fetches a collection of records
	* Optional query parameters
		* page - number
		* limit - number
* GET -> **{your-host}/api/object/{a key}**
	* Fetches the latest data with that given key
* GET - **{your-host}/api/object/{a key}?timestamp={unix timestamp value}**
	* Fetches a particular record givent the key and timesamp

**Live testing**
- You can test the application live on http://54.163.140.64/
	- Example: http://54.163.140.64/api/object/get-all-records