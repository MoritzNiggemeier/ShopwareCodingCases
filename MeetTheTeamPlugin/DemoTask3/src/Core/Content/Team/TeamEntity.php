<?php declare(strict_types=1);

namespace Demo\Core\Content\Team;

use Shopware\Core\Content\Media\MediaEntity;
use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityIdTrait;

class TeamEntity extends Entity
{
	use EntityIdTrait;

	protected ?string $name;
	
	protected ?string $position;
	
	protected ?string $text;
	
	protected ?string $image_id;
	
	protected ?string $imageBG_id;
	
	protected ?MediaEntity $image_media;
	
	protected ?MediaEntity $imageBG_media;

	public function getName() : string
	{
		return $this->name;
	}

	public function setName( string $name ) : void
	{
		$this->name = $name;
	}

	public function getPosition() : string
	{
		return $this->position;
	}

	public function setPosition( string $position ) : void
	{
		$this->position = $position;
	}

	public function getText() : string
	{
		return $this->text;
	}

	public function setText( string $text ) : void
	{
		$this->text = $text;
	}

	public function getImage_id() : string
	{
		return $this->image_id;
	}

	public function setImage_id( string $image_id ) : void
	{
		$this->image_id = $image_id;
	}

	public function getImageBG_id() : string
	{
		return $this->imageBG_id;
	}

	public function setImageBG_id( string $imageBG_id ) : void
	{
		$this->imageBG_id = $imageBG_id;
	}

	public function getImage_media() : MediaEntity
	{
		return $this->image_media;
	}

	public function setImage_media( MediaEntity $image_media ) : void
	{
		$this->image_media = $image_media;
	}

	public function getImageBG_media() : MediaEntity
	{
		return $this->imageBG_media;
	}

	public function setImageBG_media( MediaEntity $imageBG_media ) : void
	{
		$this->imageBG_media = $imageBG_media;
	}

}