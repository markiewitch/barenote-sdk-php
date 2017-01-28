<?php
namespace Barenote\SDK\Enum;

use MyCLabs\Enum\Enum;

/**
 * Class ApiEndpoint
 * @package BareNote\SDK\Enum
 * @method static ApiEndpoint NOTE()
 * @method static ApiEndpoint TAG()
 * @method static ApiEndpoint REGISTER()
 */
class ApiEndpoint extends Enum
{
    const LOGIN = '/api/login';
    const NOTE = '/api/note';
    const TAG = '/api/tag';
    const REGISTER = '/api/register';

    public static function LOGIN()
    {
        return new ApiEndpoint(self::LOGIN);
    }

    /**
     * Format URL with a resource id
     * @param int $id
     * @return string
     * @throws \Exception
     */
    public function formatForResource(int $id):string
    {
        if (!$this->isResourceful()) {
            throw new \Exception("This endpoint does not contain any resources");
        }

        return $this->getValue() . "/$id";
    }

    public function isResourceful(): bool
    {
        return array_search($this, $this->getResourceful()) !== false;
    }

    public function getResourceful(): array
    {
        return [
            static::NOTE(),
            static::TAG()
        ];
    }
}