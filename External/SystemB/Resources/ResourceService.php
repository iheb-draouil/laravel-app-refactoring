<?php

namespace External\SystemB\Resources;

class ResourceService
{
    /**
     * @throws ServiceUnavailableException
     *
     * @return array
     */
    public function getTitles(): array
    {
        return [
            'Per no modo erroribus percipitur',
            'Mutat accusam fastidii quo id',
            'Vis et cetero accommodare',
        ];
    }
}
