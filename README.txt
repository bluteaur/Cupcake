# Cupcake
Edit/Add any ideas here:


index.php:

  - This is the first page to be seen, so it should be the login page.
      STEPS (TOP TO BOTTOM) OF PAGE LAYOUT:
  - 1. Should check post to see if a user logged in/signed up
        - signup: create account with database and move the login bellow
        - login: create session for user and continue to step 2
  - 2. Should use php to check sessions if already logged in
        - if logged in then redirect to main page of site (main.php) and exit
        - if not then continue to step 3
  - 3. Display login/Signup prompt 
        - we don't need much more than a username and a password for login/signup
  - 4. When the information is sent, it should use a post method with action "index.php"

    More steps if wanted
  - 5. Add some javascript or use php to show validations on information entered
  - 6. (REPLACES STEP 5) add some AJAX to check validations and signups/logins to avoid additionnal page loads.
            - Still needs php aspect to check validation for security, but this will cut down loads
            - This step goes just before step 4 and continues on success to that step



-------------------

main.php:

  - This is the Main Page of the site. To be layed out


-------------------

More pages added here
