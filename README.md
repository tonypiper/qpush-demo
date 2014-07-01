QPush Demo
==========

Tony Piper <tpiper@inviqa.com> 2014-07-01

This is a very rough and ready demo of using IronMQ push queues with the uecode/qpush-bundle.



# Installation


0. run composer install to install symfony and the other dependencies
1. create an account on http://www.iron.io/ (it's free for 10 million API calls per month)
2. create an IronMQ project
3. copy the Token and Project ID and put them into app/config/parameters.yml

e.g.

    ironmq_token: <token here>
    ironmq_project_id: <project id here>

4. install ngrok from https://ngrok.com/ - we'll use this to tunnel from the internet to your machine
5. start the symfony built in webserver in a new terminal window - `app/console server:run`
6. start ngrok in a new terminal window - `ngrok 8000`
7. paste the nrgok url into app/config/parameters.yml

eg.

    ironmq_endpoint1_url: http://<something>.ngrok.com

8. all being well, you can run app/console app:demo1. This will post 10 messages to IronMQ.

If you examine app/logs/dev.log you'll see the messages being posted, and then the inbound messages being processed by
src/Inviqa/Bundle/QPushDemoBundle/Service/Queue1Service.php. The implementation simulates random failures, and you
should see that IronMQ retries. Ultimately it will give up.

IronMQ by default gives a job 60 seconds to complete. After that it'll be put back on the queue.

IronMQ will send one job at a time to the pool or endpoints.

TODO:
* experiment with listing the same endpoint multiple times (and changing the IronMQ push configuration to 'unicast')
* experiment with creating multiple queues
* read about the other configuration options at http://qpush-bundle.readthedocs.org/en/latest/index.html

