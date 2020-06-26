<?php


namespace App\Entity;


class AdminSearch
{
    /**
     * @var string|null
     */
    private $findByName;



    /**
     * @return string|null
     */
    public function getFindByName(): ?string
    {
        return $this->findByName;
    }

    /**
     * @param string|null $findByName
     *
     * @return AdminSearch
     */
    public function setFindByName(string $findByName)
    {
        $this->findByName = $findByName;
        return $this;
    }

}
