<?php


namespace App\Http\Helpers;


class TreeHelperController
{

    /**
     * @param $elements
     * @param int $parentId
     * @return array
     */
    public function buildTree($elements, $parentId = 0): array
    {
            $branch = [];
            foreach ($elements as $element) {

                if ((int)$element['parent_id'] === $parentId) {

                    $children = $this->buildTree($elements, $element['id']);
                    if ($children) {
                        $element['children'] = $children;
                    }  else {
                        $element['children'] = [];
                    }
                    $branch[] = $element;
                }

            }

            return $branch;
    }
}
