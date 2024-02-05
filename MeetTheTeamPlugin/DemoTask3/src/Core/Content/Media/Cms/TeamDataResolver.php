<?php declare(strict_types=1);

namespace Demo\Core\Content\Media\Cms;

use Demo\Core\Content\Team\TeamDefinition;
use Shopware\Core\Framework\Struct\ArrayStruct;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Content\Cms\Aggregate\CmsSlot\CmsSlotEntity;
use Shopware\Core\Content\Cms\DataResolver\Element\AbstractCmsElementResolver;
use Shopware\Core\Content\Cms\DataResolver\Element\ElementDataCollection;
use Shopware\Core\Content\Cms\DataResolver\ResolverContext\ResolverContext;
use Shopware\Core\Content\Cms\DataResolver\CriteriaCollection;

class TeamDataResolver extends AbstractCmsElementResolver
{
    public function getType(): string
    {
        return 'team-cms-element';
    }

    public function collect(CmsSlotEntity $slot, ResolverContext $resolverContext): ?CriteriaCollection
    {

        $memberIds = [];
        foreach( $slot->getFieldConfig()->get('teamMembers')->getValue() as $member ){
            $memberIds[] = $member['id'];
        }

        $criteria = (new Criteria($memberIds))
            ->addAssociation('image_media')
            ->addAssociation('imageBG_media');

        $criteriaCollection = new CriteriaCollection();
        $criteriaCollection->add('teamMembers' . $slot->getUniqueIdentifier(), TeamDefinition::class, $criteria);

        return $criteriaCollection;
    }

    public function enrich(CmsSlotEntity $slot, ResolverContext $resolverContext, ElementDataCollection $result): void
    {

        $data = new ArrayStruct();
        foreach ($result->get('teamMembers' . $slot->getUniqueIdentifier())->getElements() as $member) {
            $data->set( $member->get('id'), [
                'name' => $member->get('name'),
                'position' => $member->get('position'),
                'text' => $member->get('text'),
                'image' => $member->get('image_media'),
                'imageBG' => $member->get('imageBG_media')
            ]);
        }
        $slot->setData( $data );
    }
}