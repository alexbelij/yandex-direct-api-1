<?php

namespace directapi\services\adgroups;

use directapi\common\criterias\IdsCriteria;
use directapi\common\criterias\LimitOffset;
use directapi\common\results\ActionResult;
use directapi\services\adgroups\criterias\AdGroupsSelectionCriteria;
use directapi\services\adgroups\enum\AdGroupFieldEnum;
use directapi\services\adgroups\enum\DynamicTextAdGroupFieldEnum;
use directapi\services\adgroups\enum\DynamicTextFeedAdGroupFieldEnum;
use directapi\services\adgroups\enum\MobileAppAdGroupFieldEnum;
use directapi\services\adgroups\models\AdGroupAddItem;
use directapi\services\adgroups\models\AdGroupGetItem;
use directapi\services\adgroups\models\AdGroupUpdateItem;
use directapi\services\BaseService;

class AdGroupsService extends BaseService
{
    const SERVICE = 'AdGroups';
    
    /**
     * @param AdGroupAddItem[] $AdGroups
     * @throws \Exception
     *
     * @return ActionResult[]
     */
    public function add(array $AdGroups)
    {
        $params = [
            self::SERVICE => $AdGroups
        ];
        return parent::doAdd($params);
    }

    /**
     * @inheritdoc
     */
    public function delete(IdsCriteria $SelectionCriteria)
    {
        return parent::delete($SelectionCriteria);
    }

    /**
     * @param AdGroupsSelectionCriteria                 $SelectionCriteria
     * @param AdGroupFieldEnum[]                        $FieldNames
     * @param MobileAppAdGroupFieldEnum[]               $MobileAppAdGroupFieldNames
     * @param DynamicTextAdGroupFieldEnum[]             $DynamicTextAdGroupFieldNames
     * @param DynamicTextFeedAdGroupFieldEnum[]         $DynamicTextFeedAdGroupFieldNames
     * @param LimitOffset|null                          $Page
     *
     * @return AdGroupGetItem[]
     */
    public function get(
        AdGroupsSelectionCriteria $SelectionCriteria,
        array $FieldNames,
        array $MobileAppAdGroupFieldNames = [],
        array $DynamicTextAdGroupFieldNames = [],
        array $DynamicTextFeedAdGroupFieldNames = [],
        LimitOffset $Page = null
    ) {
        $params = [
            'SelectionCriteria' => $SelectionCriteria,
            'FieldNames'        => $FieldNames,
        ];
        if ($MobileAppAdGroupFieldNames) {
            $params['MobileAppAdGroupFieldNames'] = $MobileAppAdGroupFieldNames;
        }
        if ($DynamicTextAdGroupFieldNames) {
            $params['DynamicTextAdGroupFieldNames'] = $DynamicTextAdGroupFieldNames;
        }
        if ( $DynamicTextFeedAdGroupFieldNames ) {
            $params['DynamicTextFeedAdGroupFieldNames'] = $DynamicTextFeedAdGroupFieldNames;
        }

        if ($Page) {
            $params['Page'] = $Page;
        }
        return parent::doGet($params, self::SERVICE, null);
    }

    /**
     * @param AdGroupUpdateItem[] $AdGroups
     * @throws \Exception
     *
     * @return ActionResult[]
     */
    public function update(array $AdGroups)
    {
        $params = [
            self::SERVICE => $AdGroups
        ];
        return parent::doUpdate($params);
    }

    protected function getName()
    {
        return strtolower(self::SERVICE);
    }
}