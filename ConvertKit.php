<?php
namespace Firewards\Apis\ConvertKit;

use ConvertKit_API\ConvertKit_API;

/**
 * Badges
 *
 * @author            Dennis Stücken
 * @license           proprietary
 * @copyright         firewards.com
 * @link              https://www.firewards.com
 *
 * @version           $Version$
 * @package           DS\Model
 *
 * @method static findFirstById(int $id)
 */
class ConvertKit extends ConvertKit_API
{
    /**
     * @param int $page
     *
     * @return false|mixed
     */
    public function getSubscribers($page = 1, $sort_order = null, $from = null, $to = null, $updated_from = null, $updated_to = null, $email_address = null)
    {

        $request = $this->api_version . '/subscribers';

        $options = [
            'api_secret' => $this->api_secret,
        ];

        if ($page)
        {
            $options['page'] = $page;
        }

        if ($from)
        {
            $options['from'] = $from;
        }

        if ($to)
        {
            $options['to'] = $to;
        }

        if ($updated_from)
        {
            $options['updated_from'] = $updated_from;
        }

        if ($updated_to)
        {
            $options['updated_to'] = $updated_to;
        }

        if ($sort_order)
        {
            $options['sort_order'] = $sort_order;
        }

        if ($email_address)
        {
            $options['email_address'] = $email_address;
        }

        return $this->make_request($request, 'GET', $options);
    }

    /**
     * @return false|mixed
     */
    public function getCustomFields()
    {
        $request = $this->api_version . '/custom_fields';

        $options = [
            'api_key' => $this->api_key,
        ];

        return $this->make_request($request, 'GET', $options);
    }

    /**
     * @param string $label
     *
     * @return false|mixed
     */
    public function createCustomField(string $label)
    {
        $request = $this->api_version . '/custom_fields';

        $options = [
            'api_secret' => $this->api_secret,
            'label' => $label,
        ];

        return $this->make_request($request, 'POST', $options);
    }

    /**
     * @param string $subscriberId
     * @param array  $fields
     *
     * @return false|mixed
     */
    public function updateSubscriber(string $subscriberId, array $fields = [])
    {
        $request = $this->api_version . '/subscribers/' . $subscriberId;

        $options = [
            'api_secret' => $this->api_secret,
            'fields' => $fields,
        ];

        return $this->make_request($request, 'PUT', $options);
    }

    /**
     * @param string $name
     *
     * @return false|mixed
     */
    public function createTag(string $name)
    {
        $request = $this->api_version . '/tags';

        $options = [
            'api_secret' => $this->api_secret,
            'tag' => ['name' => $name],
        ];

        return $this->make_request($request, 'POST', $options);
    }

    /**
     * @return false|mixed
     */
    public function getTags()
    {
        $request = $this->api_version . '/tags';

        $options = [
            'api_secret' => $this->api_secret,
        ];

        return $this->make_request($request, 'GET', $options);
    }

    /**
     * @param string $tagId
     * @param string $email
     * @param string $firstName
     * @param array  $fields
     *
     * @return false|mixed
     */
    public function addSubscriberToTag(string $tagId, string $email, string $firstName = '', array $fields = [])
    {
        $request = $this->api_version . '/tags/' . $tagId . '/subscribe';

        $options = [
            'api_secret' => $this->api_secret,
            'email' => $email,
            'first_name' => $firstName,
            'fields' => $fields,
        ];

        return $this->make_request($request, 'POST', $options);
    }
}
