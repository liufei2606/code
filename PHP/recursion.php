<?php

/**
 * 根据 id 获取机构二级目录名称
 * @param $id
 * @return mixed|string
 */
public static function getTwoPhraseOranizationById($id)
{
    $selfInfo = Organization::find()->select('id,title,parent_id')->where(['id' => $id])->asArray()->one();

    if ($selfInfo['parent_id'] > 0) {
        $parentInfo = Organization::getTwoPhraseOranizationById($selfInfo['parent_id']);

        if (null != $parentInfo) {
            return $parentInfo .'-'.$selfInfo['title'];
        }
    }

    return $selfInfo['title'];
}
