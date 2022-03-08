<?php
namespace Models\Articles;

use InvalidArgumentException;
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

    public static function createFromArray( array $fields, User $author) : Article
    {
        if (empty ($fields['name']))
        {
            throw new InvalidArgumentException("Не передано название статьи!");
        }

        if (empty ($fields['text']))
        {
            throw new InvalidArgumentException("Не передан текст статьи!");
        }

        $article = new Article();
        $article->setAuthor($author);
        $article->setName($fields['name']);
        $article->setText($fields['text']);

        $article->save();

        return $article;

    }

    public function updateFromArray (array $fields) : Article
    {
        if (empty($fields['name']))
        {
            throw new InvalidArgumentException('Не передано название статьи!');
        }

        if (empty($fields['text']))
        {
            throw new InvalidArgumentException('Не передан текст статьи!');
        }

        $this->setName($fields['name']);
        $this->setText($fields['text']);
        $this->save();

        return $this;
    }


}


?>