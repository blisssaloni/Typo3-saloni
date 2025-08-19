<?php

declare (strict_types = 1);

namespace NITSAN\NsCourses\Domain\Model;

class News extends \GeorgRinger\News\Domain\Model\News
{
    protected ?\GeorgRinger\News\Domain\Model\FileReference $featureImage = null;
    protected ?string $subtitle                                             = null;

    protected ?string $descriptionNews = null;

    public function getSubtitle(): ?string
    {
        return $this->subtitle;
    }

    public function setSubtitle(?string $subtitle): void
    {
        $this->subtitle = $subtitle;
    }

    public function getDescriptionNews(): ?string
    {
        return $this->descriptionNews;
    }

    public function setDescriptionNews(?string $descriptionNews): void
    {
        $this->descriptionNews = $descriptionNews;
    }

    public function getFeatureImage(): ?\GeorgRinger\News\Domain\Model\FileReference
    {
        return $this->featureImage;
    }

    public function setFeatureImage( ? \GeorgRinger\News\Domain\Model\FileReference $featureImage) : void
    {
        $this->featureImage = $featureImage;
    }

}
