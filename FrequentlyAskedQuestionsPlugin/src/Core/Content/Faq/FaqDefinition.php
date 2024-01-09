<?php declare(strict_types=1);

namespace CodingCase\Core\Content\Faq;

use Shopware\Core\Content\Product\ProductDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IdField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\StringField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToManyAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;


class FaqDefinition extends EntityDefinition
{
	public const ENTITY_NAME = 'faq';

	public function getEntityName(): string
	{
		return self::ENTITY_NAME;
	}

	public function getEntityClass(): string
	{
		return FaqEntity::class;
	}

	public function getCollectionClass(): string
	{
		return FaqCollection::class;
	}

	protected function defineFields(): FieldCollection
	{
		return new FieldCollection([
			(new IdField('id', 'id'))->addFlags(new Required(), new PrimaryKey()),
			(new StringField('question', 'question'))->addFlags(new Required()),
			(new StringField('answer', 'answer')),
			(new ManyToManyAssociationField('products', ProductDefinition::class, FaqProductMappingDefinition::class, 'faq_id', 'product_id'))
		]);
	}
}