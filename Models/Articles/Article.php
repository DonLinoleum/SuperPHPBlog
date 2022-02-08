<?php
namespace Models\Articles;
use \Models\Users\User;

class Article extends \Models\ActiveRecordEntity
{
    /** @var string */
    protected $name;

    /** @var string */
    protected $text;

    /** @var int */
    protected $authorId;

    /** @var string */
    protected $createdAt;

    
    public function getName()
    {
        return $this->name;
    }

    public function setName($value)
    {
        $this->name = $value;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setText($value)
    {
        $this->text = $value;
    }

    public function getAuthor() 
    {
        return User::getById($this->authorId);
    }

    public function setAuthor(User $author)
    {
        $this->authorId = $author->getId();
    }

    static protected function getTableName(): string
    {
        return 'articles';
    }


}


?>