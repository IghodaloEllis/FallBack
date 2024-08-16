# FallBack
This script will send an email to a selected email address if the user doesn't login for 3 years.

## key points:

### Data Storage
Where is the user's last login date stored? (e.g., database, session, cookie)

### Email Functionality
How will you send the email? (e.g., PHP's mail() function, a third-party library like PHPMailer)

### Error Handling
What happens if there's an error sending the email?
The user's last login date is stored in a database column named last_login as a timestamp.
You're using PHP's mail() function to send emails.
Basic error handling for email sending.
