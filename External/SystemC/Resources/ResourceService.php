<?php

namespace External\SystemC\Resources;

use External\SystemC\Exceptions\ServiceUnavailableException;

class ResourceService
{
    /**
     * @throws ServiceUnavailableException
     *
     * @return array
     */
    public function getTitles(): array
    {
        if (rand(0, 20) === 0)
        {
            throw new ServiceUnavailableException();
        }

        return [
            'titles' => [
                'Eu vel noster reprehendunt',
                'Vim ubique legendos te',
                'Usu simul laboramus at',
            ]
        ];
    }
}
