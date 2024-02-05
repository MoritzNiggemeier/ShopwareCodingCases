<?php declare(strict_types=1);

namespace Demo\Core\Content\Team;

use Shopware\Core\Content\Media\MediaDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IdField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\FkField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\StringField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToOneAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\AllowHtml;


class TeamDefinition extends EntityDefinition
{
	public const ENTITY_NAME = 'team';

	public function getEntityName(): string
	{
		return self::ENTITY_NAME;
	}

	public function getEntityClass(): string
	{
		return TeamEntity::class;
	}

	public function getCollectionClass(): string
	{
		return TeamCollection::class;
	}

	protected function defineFields(): FieldCollection
	{
		return new FieldCollection([
			(new IdField('id', 'id'))->addFlags(new Required(), new PrimaryKey()),
			(new StringField('name', 'name'))->addFlags(new Required()),
			(new StringField('position', 'position'))->addFlags(new Required()),
			(new StringField('text', 'text'))->addFlags(new AllowHtml()),
			(new FkField('image_id', 'image_id', MediaDefinition::class)),
			(new FkField('imageBG_id', 'imageBG_id', MediaDefinition::class)),
			(new ManyToOneAssociationField('image_media', 'image_id', MediaDefinition::class, 'id')),
			(new ManyToOneAssociationField('imageBG_media', 'imageBG_id', MediaDefinition::class, 'id'))
		]);
	}
}