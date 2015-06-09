<?php
/**
 * Create a client to talk to the Twilio Lookups API.
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
 *      $client = new Lookups_Services_Twilio('AC123', '456bef', null, null, 3);
 *      // Take some action with the client, etc.
 */
class Lookups_Services_Twilio extends Base_Services_Twilio
{
    protected $versions = array('v1');
    private $accountSid;

    public function __construct(
        $sid,
        $token,
        $version = null,
        Services_Twilio_TinyHttp $_http = null,
        $retryAttempts = 1
    )
    {
        parent::__construct($sid, $token, $version, $_http, $retryAttempts);

        $this->accountSid = $sid;
        $this->phone_numbers = new Services_Twilio_Rest_Lookups_PhoneNumbers($this, "/{$this->version}/PhoneNumbers");
    }

	/**
	 * Construct a URI based on initial path, query params, and paging
	 * information
	 *
	 * We want to use the query params, unless we have a next_page_uri from the
	 * API.
	 *
	 * :param string $path: The request path (may contain query params if it's
	 *      a next_page_uri)
	 * :param array $params: Query parameters to use with the request
	 * :param boolean $full_uri: Whether the $path contains the full uri
	 *
	 * :return: the URI that should be requested by the library
	 * :returntype: string
	 */
	public function getRequestUri($path, $params, $full_uri = false)
	{
		if (!$full_uri && !empty($params)) {
			$query_path = $path . '?' . http_build_query($params, '', '&');
		} else {
			$query_path = $path;
		}
		return $query_path;
	}

    /**
     * Get the base URI for this client.
     *
     * :return: base URI
     * :rtype: string
     */
    protected function _getBaseUri()
    {
        return 'https://lookups.twilio.com';
    }

}
