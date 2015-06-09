<?php
/**
 * Create a client to talk to the Twilio Rest API.
 *
 *
 * :param string               $sid:      Your Account SID
 * :param string               $token:    Your Auth Token from `your dashboard
 *      <https://www.twilio.com/user/account>`_
 * :param string               $version:  API version to use
 * :param $_http:    A HTTP client for making requests.
 * :type $_http: :php:class:`Services_Twilio_TinyHttp`
 * :param int                  $retryAttempts:
 *      Number of times to retry failed requests. Currently only idempotent
 *      requests (GET's and DELETE's) are retried.
 *
 * Here's an example:
 *
 * .. code-block:: php
 *
 *      require('Services/Twilio.php');
 *      $client = new Services_Twilio('AC123', '456bef', null, null, 3);
 *      // Take some action with the client, etc.
 */
class Services_Twilio extends Base_Services_Twilio
{
    protected $versions = array('2008-08-01', '2010-04-01');

    public function __construct(
        $sid,
        $token,
        $version = null,
        Services_Twilio_TinyHttp $_http = null,
        $retryAttempts = 1
    )
    {
        parent::__construct($sid, $token, $version, $_http, $retryAttempts);

        $this->accounts = new Services_Twilio_Rest_Accounts($this, "/{$this->version}/Accounts");
        $this->account = $this->accounts->get($sid);
    }
}
