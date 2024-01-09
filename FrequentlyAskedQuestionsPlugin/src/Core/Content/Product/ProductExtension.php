<?php declare(strict_types=1);

namespace CodingCase\Core\Content\Product;

use Shopware\Core\Content\Product\ProductDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityExtension;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToManyAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Inherited;
use CodingCase\Core\Content\Faq\FaqDefinition;
use CodingCase\Core\Content\Faq\FaqProductMappingDefinition;

class ProductExtension extends EntityExtension
{
	public function getDefinitionClass(): string
	{
		return ProductDefinition::class;
	}

	 public function extendFields(FieldCollection $collection): void
	{
		$collection->add(
			(new ManyToManyAssociationField(
				'faqs',
				FaqDefinition::class,
				FaqProductMappingDefinition::class,
				'product_id',
				'faq_id'
			))->addFlags(new Inherited())
		);
	}

}