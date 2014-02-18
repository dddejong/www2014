// $Id$

This module automatically updates the time zone setting on user accounts. This
is accomplished by using JavaScript on the client machine to send the data back
to the server. The benefit is that users don't have to manually update their
time zones in their profiles.


Installation
------------

  1. Copy the autotimezone directory to your modules directory.

  2. Login as site administrator.

  3. Enable Auto Time Zone at Administer >> Site building >> Modules.


Usage
-----

The setting Site configuration >> Date and time >> Configurable time zones must
be enabled for this module to work.

This module has the optional feature of setting a $_SESSION['timezone'] variable
for guest users. This feature can be used in custom code or other modules when a
guest user’s time zone is needed. The value of $_SESSION['timezone'] is in
minutes from GMT.
