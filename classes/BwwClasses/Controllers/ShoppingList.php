<?php
namespace BwwClasses\Controllers;

use \utilityClasses\Authentication;
use \utilityClasses\DatabaseTable;

class ShoppingList
{
    private $authentication;
    private $shoppingCategoriesTable;
    private $shoppingItemsTable;
    public function __construct(DatabaseTable $shoppingCategoriesTable, DatabaseTable $shoppingItemsTable, Authentication $authentication)
    {
        $this->shoppingCategoriesTable = $shoppingCategoriesTable;
        $this->shoppingItemsTable = $shoppingItemsTable;
        $this->authentication = $authentication;
    }

    public function render()
    {
        $loggedIn = $this->authentication->isLoggedIn();
        $userDatas = [];
        if ($loggedIn) {
            $user = $this->authentication->getUser();
            $shoppingCategories = [];
            $shoppingItems = [];
            $categories = $this->shoppingCategoriesTable->findAll();
            $shopItems = $this->shoppingItemsTable->findAll();
            foreach ($categories as $category) {
                if ($user['id'] != $category['author_id']) {
                    continue;
                }
                $shoppingCategories[] = [
                    'id' => (int)$category['id'],
                    'category' => (string)$category['category'],
                ];
            }
            $_SESSION['shoppingCategories'] = $shoppingCategories ?? null;

            foreach ($shopItems as $shopItem) {
                if ($user['id'] != $shopItem['author_id']) {
                    continue;
                }
                $shoppingItems[] = [
                    'id' => (int)$shopItem['id'],
                    'category_id' => (int)$shopItem['category_id'],
                    'item_name' => (string)$shopItem['item_name'],
                ];
            }
            $_SESSION['shoppingCategories'] = $shoppingItems ?? null;

            return [
                'template' => 'shoppinglist.html.php',
                'title' => 'Shopping List',
                'variables' => [
                    'loggedIn' => $loggedIn,
                    'shoppingCategories' => $shoppingCategories ?? null,
                    'shoppingItems' => $shoppingItems ?? null,
                ],
            ];
        }
        return [
            'template' => 'shoppinglist.html.php',
            'title' => 'Shopping List',
            'variables' => [
                'loggedIn' => $loggedIn,
            ],
        ];
    }

    public function processUserRequest()
    {
        // print_r("processUserRequest has been called");die;
        $newCategoryName = "";
        $newItemCategoryIds = [];
        $newItemNames = [];

        if (isset($_POST['itemcategoryid'])) {
            foreach ($_POST['itemcategoryid'] as $key => $value) {
                if (!empty($value)) {
                    $newItemCategoryIds[] = $value;
                }
            }
        }

        if (isset($_POST['newitem'])) {
            foreach ($_POST['newitem'] as $key => $value) {
                if (!empty($value)) {
                    $newItemNames[] = $value;
                }
            }
        }

        if (isset($_POST['newcategory']) && !empty($_POST['newcategory'])) {
            // print_r("Going down save new category route");die;
            $newCategoryName = (string)$_POST['newcategory'];
            $this->saveNewCategory($newCategoryName);
        } else if (isset($_POST['shopcategory'])) {
            // print_r("Going down delete category route");die;
            $shopCat = [];
            $shopCat = $_POST['shopcategory'];

            $shopCatIds = [];
            $shopCatIds = array_keys($shopCat, true);
            $shopCatIdsLength = sizeof($shopCatIds, 0);
            for ($id = 0; $id < $shopCatIdsLength; $id++) {
                $this->deleteShoppingCategory($shopCatIds[$id]);
            }
        } else if (isset($_POST['shopitem'])) {
            // print_r("Going down delete shopping item route");die;
            $shopItemIdsArray = [];
            // foreach loop to extract new item category id's and names
            foreach ($_POST['hiddenInputshopitem'] as $key => $value) {
                if (!empty($value)) {
                    $shopItemIdsArray[] = $value;
                }
            }
            $shopItemIdsLength = sizeof($shopItemIdsArray, 0);
            for ($shopItem = 0; $shopItem < $shopItemIdsLength; $shopItem++) {
                $this->deleteShoppingItem($shopItemIdsArray[$shopItem]);
            }
        } else if (isset($newItemNames) && !empty($newItemNames)) {
            // print_r("Going down save new item route");die;
            for ($i = 0; $i < sizeof($newItemNames, 0); $i++) {
                $this->saveNewItem($newItemCategoryIds[$i], $newItemNames[$i]);
            }
        } else {
            // print_r("Going down default route");die;
            header('location: /shoppinglist');
        }
    }

    private function saveNewCategory($newCategoryName)
    {
        $user = $this->authentication->getUser();
        $userId = (int)$user['id'];
        $newCategoryData = [];
        $newCategoryData['category'] = $newCategoryName;
        $newCategoryData['author_id'] = $userId;
        $this->shoppingCategoriesTable->save($newCategoryData);
        header('location: /shoppinglist');
    }

    private function deleteShoppingCategory($id)
    {
        $user = $this->authentication->getUser();

        $shoppingCat = $this->shoppingCategoriesTable->findById($id);

        if ($shoppingCat['author_id'] != $user['id']) {
            return;
        }

        $this->shoppingCategoriesTable->delete($id);
        header('location: /shoppinglist');
    }

    private function saveNewItem($categoryId, $newItemName)
    {
        $user = $this->authentication->getUser();
        $userId = (int)$user['id'];
        $newItemData = [];
        $newItemData['item_name'] = $newItemName;
        $newItemData['category_id'] = $categoryId;
        $newItemData['author_id'] = $userId;
        $this->shoppingItemsTable->save($newItemData);
        header('location: /shoppinglist');
    }

    private function deleteShoppingItem($id)
    {
        $user = $this->authentication->getUser();
        $shoppingItem = $this->shoppingItemsTable->findById($id);

        if ($shoppingItem['author_id'] != $user['id']) {
            return;
        }

        $this->shoppingItemsTable->delete($id);
        header('location: /shoppinglist');
    }
}