<b>Google Calendar API</b>

Done in Laravel => both frontend and backend with communication between them

In order to work with this API, it must be enabled on Google logged in user => next step is to create OAuth2 credentials which can be downloaded in JSON format (Credentials json file is stored in google/config file).

On first user try to submit event to calendar, he would be prompted to create <b>token</b> which is neccessary for authentication of that user. Token is stored in same path as credentials.json => after token is created, and credentials are set, on event submit action user is redirected to accept usage of Google Calendar on it's google profile, and finally event is created.

All information that user enters in input fields are displayed in calendar event, and email notification of event creation is added to email spam folder. User also get neccessary reminders 15 and 30mins before meeting.

Max event attendees is not limited.

Frontend uses standard validation for required inputs, all input fields uses custom Request validation and complete form is spam protected with honeypot library, and bot protected with standard google recaptcha library.
