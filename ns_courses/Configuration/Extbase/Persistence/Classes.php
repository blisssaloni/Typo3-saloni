<?php

return [
    \GeorgRinger\News\Domain\Model\News::class => [
        'subclasses' => [
            'nitsan-news' => \NITSAN\NsCourses\Domain\Model\News::class,
        ],
    ],
    \NITSAN\NsCourses\Domain\Model\News::class => [
        'tableName' => 'tx_news_domain_model_news',
        
    ],
];
