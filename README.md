# Feature

Offers a simple way of logging if a feature of your application is used and how often.

First you have to create a new feature:

```phpregexp
use PatrickRiemer\Feature\Feature;

$feature = Feature::create('email_reporting', 'Enabled email reporting');
```

After this you can log whenever a user is invoking your new feature. The user_id is optional:

```phpregexp
Feature::log($feature, auth()->id());
Feature::log($feature);
```

By default the database entry will be created with a job. If you want to create it directly, you can add the following flag to your environment file:

```baBash
FEATURE_NO_JOB=true
```

If you want to turn off logging of the user id even if it is passed as argument, you can disable this with the following flag:

```baBash
FEATURE_LOG_USER=false
```