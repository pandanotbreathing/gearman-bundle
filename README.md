# Horrible Gearman Bundle Documentation


## Configuration

1. Add following configuration to your config.yml:

```
horrible_gearman: 
    servers: 
        - { host: '127.0.0.1' } 
        - { host: '127.0.0.1', port: '47031' } 
    retries: 3
```

- servers - an array of the gearman servers, you can ignore 'port' field, gearman's default port will be used.
- retries - amount of retries if exception would be thrown from Job

2. Add bundle initialization to the app/AppKernel.php

```
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = [
            ...
            new Horrible\GearmanBundle\HorribleGearmanBundle(),
        ];
    }
    ...
}
```

3. Create your own Job implemeting JobInterface. It's important to give your job name (so you can access your job
through client using this job name). Also implement your 'execute' method where you can get WorkloadInterface instance.

```
<?php

namespace AppBundle\Job;

use Horrible\GearmanBundle\Job\JobInterface;
use Horrible\GearmanBundle\Workload\WorkloadInterface;

class Job implements JobInterface
{
    /**
     * {@inheritDoc}
     */
    public function execute(WorkloadInterface $workload)
    {
        $data = $workload->getDecodedData();
        //do your stuff
    }

    public function getName()
    {
        return 'your:job:name';
    }
}
```

4. Register your Job as a service and add tag with the name **'horrible.gearman.job'** to it

**services.yml**
```
services:
    your.job:
        class: AppBundle\Job\Job
        tags:
            - { name: 'horrible.gearman.job' }
```

5. Start workers

To have workers started you should call command **'horrible:worker:work'**.
If you have to have your worker started in background you could do:


Symfony < 3 version
```
php app/console horrible:worker:work &
```

Symfony >= 3 version
```
php bin/console horrible:worker:work &
```

6. Add a task through client

**SomeController.php**
```
$workload = new SimpleWorkload();
$workload->setDecodedData([
    'some your data' => 'value',
    ...
]);

$this->get('horrible.gearman.client')->doBackground('your:job:name', $workload);
```

Workload data would be encoded as json (in case of SimpleWorkload usage) and passed to Gearman, and you would get
it as WorkloadInterface instance in your Job->execute method

Mainly all 'horrible.gearman.client' methods are the same as in the GearmanClient (http://php.net/manual/ru/class.gearmanclient.php)
but instead of workload as a string it uses WorkloadInterface instance

**Workload** is not required parameter, if you'd skip it you'll get WorkloadInterface instance in your job which
will have '0' inside as a value


## Events

Bundle has several types of events:

- JobStartedEvent ('horrible.event.job.started') - fires before job has been started, contains inside
        - $jobName (string)
        - $workload (WorkloadInterface instance)
        - $workerId (string) - worker id which is processing current job

- JobFinishedEvent ('horrible.event.job.finished') - fires after successfully finished job, contains inside
        - $jobName (string)
        - $workload (WorkloadInterface instance)
        - $jobResult (mixed) - data which is returned from the Job->execute() method
        - $workerId (string) - worker id which is processing current job

- JobFailedEvent ('horrible.event.job.failed') - fires before job has been started, contains inside
        - $jobName (string)
        - $workload (WorkloadInterface instance)
        - $exception (object) - Exception instance which was thrown out of the job
        - $workerId (string) - worker id which is processing current job


To catch these events you should use tags:

**services.yml**
```
services:
    my.event.listener:
        class: AppBundle\EventListener\MyEventListener
        tags:
            - { name: 'horrible.event_listener', event: 'horrible.event.job.started', method: 'onJobStarted' }
            - { name: 'horrible.event_listener', event: 'horrible.event.job.finished', method: 'onJobFinished' }
            - { name: 'horrible.event_listener', event: 'horrible.event.job.failed', method: 'onJobFailed' }
```

**MyEventListener**
```
<?php

namespace AppBundle\EventListener;

use Horrible\GearmanBundle\Event\JobFailedEvent;
use Horrible\GearmanBundle\Event\JobFinishedEvent;
use Horrible\GearmanBundle\Event\JobStartedEvent;

class MyEventListener
{
    public function onJobStarted(JobStartedEvent $event)
    {
        $jobName = $event->getJobName();
        $workload = $event->getWorkload();
        $workerId = $event->getWorkerId();
        //Do your stuff...
    }

    public function onJobFinished(JobFinishedEvent $event)
    {
        $jobName = $event->getJobName();
        $workload = $event->getWorkload();
        $jobResult = $event->getJobResult();
        $workerId = $event->getWorkerId();
        //Do your stuff...
    }

    public function onJobFailed(JobFailedEvent $event)
    {
        $jobName = $event->getJobName();
        $workload = $event->getWorkload();
        $exception = $event->getException();
        $workerId = $event->getWorkerId();
        //Do your stuff...
    }
}
```
