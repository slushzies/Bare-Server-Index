# Bare-Server-Index
This repository contains a simple PHP script that provides two APIs for validating, contributing, and getting info from a list of bare server URLs.
This also contains a list of uploaded BARE server urls, which can be useful for avoiding censorship through web proxies.

# API 1: Validation API
This API allows developers to validate a bare server URL by making a POST request to the endpoint with a bare_server_url JSON parameter. If the URL is valid, the API will return a response with the status "Valid". If the URL is invalid, the API will return a response with the status "Invalid". If the URL is a duplicate of an already recorded URL, the API will return a response with the status "Valid" and message "Duplicate". 

# API 2: Random API
This API allows developers to get a bare server URL to the list by making a GET request to /random.php. The API will respond with JSON like so: {"bare_server_url":"https://example.com/bare/"}.
