<?php declare(strict_types=1);

namespace CodingCase\Core\Content\Faq;

use Shopware\Core\Content\Product\ProductCollection;
use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityIdTrait;

class FaqEntity extends Entity
{
	use EntityIdTrait;

	protected ?string $question;

	protected ?string $answer;

	protected ?ProductCollection $products = null;


	public function getQuestion() : ?string
	{
		return $this->question;
	}

	public function setQuestion( ?string $question ) : void
	{
		$this->question = $question;
	}

	public function getAnswer() : ?string
	{
		return $this->answer;
	}

	public function setAnswer( ?string $answer ) : void
	{
		$this->answer = $answer;
	}

	public function getProducts(): ?ProductCollection
	{
		return $this->products;
	}

	public function setProducts( ?ProductCollection $products ) : void
	{
		$this->products = $products;
	}

}