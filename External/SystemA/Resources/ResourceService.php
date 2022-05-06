<?php

namespace External\SystemA\Resources;

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
            'titles' => [
                [
                    'title' => 'Proin ornare mollis lectus tincidunt.',
                    'summary' => 'Lorem ipsum dolor sit amet, ne agam ancillae forensibus duo, cu ius iisque deleniti reprimique. Cu has aperiri sententiae, est minim repudiare no, id veri partiendo pri. Brute sensibus incorrupte te per, ut porro repudiare vix, sit ex elit tantas semper. Minimum accusamus dignissim ad eam, ius verear viderer cotidieque ea. Brute dicta dicam per no, erat democritum ex nam.'
                ],
                [
                    'title' => 'Lorem ipsum dolor sit amet.',
                    'summary' => 'Ea eos quem decore cetero. Sed modo disputando deterruisset ne, ex munere disputando contentiones nam. Ex vis mundi timeam docendi. Volumus eleifend tincidunt cu vel, est ancillae principes concludaturque in, ignota oportere intellegam ad duo...'
                ],
            ]
        ];
    }
}
