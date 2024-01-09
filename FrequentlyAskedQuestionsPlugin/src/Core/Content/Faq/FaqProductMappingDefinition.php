<?php declare(strict_types=1);

namespace CodingCase\Core\Content\Faq;

use Shopware\Core\Content\Product\ProductDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use Shopware\Core\Framework\DataAbstractionLayer\MappingEntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\FkField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ReferenceVersionField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToOneAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;

class FaqProductMappingDefinition extends MappingEntityDefinition
{
	public const ENTITY_NAME = 'faq_product';

	public function getEntityName(): string{ return self::ENTITY_NAME; }

	protected function defineFields(): FieldCollection
	{
		return new FieldCollection([
			(new FkField('faq_id', 'faqId', FaqDefinition::class))->addFlags(new PrimaryKey(), new Required()),
			(new FkField('product_id', 'productId', ProductDefinition::class))->addFlags(new PrimaryKey(), new Required()),
			(new ReferenceVersionField(ProductDefinition::class))->addFlags(new PrimaryKey(), new Required()),
			new ManyToOneAssociationField('faq', 'faq_id', FaqDefinition::class, 'id', true),
			new ManyToOneAssociationField('product', 'product_id', ProductDefinition::class, 'id', true)
		]);
	}

}