# This project is built using the Slim Microframework

Upon cloning, run `composer install` to download all dependencies.

If serving with Apache, make sure the mod_rewrite module is enabled.

Edit the configuration variables in the /configs directory. It is recommended
to copy these files to a different directory outside the project root and edit the config/core.json
file to reflect the new location to avoid accidentally commiting them.

You can access the routes as defined in the index.php file and also on the postman workspace for this project.
All endpoints are versioned as /v1/... 