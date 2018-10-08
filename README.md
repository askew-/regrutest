Тестовое задание для Reg.Ru
-------------------

### 1
Используя Yii2 необходимо реализовать форму регистрации пользователя с
условием типа физ./юр. лицо. Для физ. лица необходимо заполнить: почту, ФИО и в
случае ИП - ИНН, а для юр. лица: почту, ФИО, название организации и инн.
Внешний вид значения не имеет.

~~~
git clone git@github.com:askew-/regrutest.git
cd regrutest
composer install
./yii migrate 
~~~


### 2
Реализовать кеширование для функции:
```php
function($date, $type) {
    $userId = Yii::$app->user->id;
    $dataList = SomeDataModel::find()->where(['date' => $date, 'type' => $type, 'user_id' => $userId])->all();
    $result = [];
    if (!empty($dataList)) {
        foreach ($dataList as $dataItem) {
            $result[$dataItem->id] = ['a' => $dataItem->a, 'b' => $dataItem->b];
        }
    }
    return $result;
}

```

2 Варианта реализации кеширования при получении данных через AR

```php
function ($date, $type)
{
    $userId = Yii::$app->user->id;
    $cacheKey = implode(',', [$date, $type, $userId]);
    $cache = \Yii::$app->cache;
    $dataList = $cache->getOrSet($cacheKey, function () use ($date, $type, $userId) {
        return SomeDataModel::find()->where(['date' => $date, 'type' => $type, 'user_id' => $userId])->all();
    }, 30 * 60);
    $result = [];
    if (!empty($dataList)) {
        foreach ($dataList as $dataItem) {
            $result[$dataItem->id] = ['a' => $dataItem->a, 'b' => $dataItem->b];
        }
    }

    return $result;
}
```

```php
function ($date, $type)
{
    $userId = Yii::$app->user->id;
    $cacheKey = implode(',', [$date, $type, $userId]);
    $dataList = SomeDataModel::find()->cache(30*60)->where(['date' => $date, 'type' => $type, 'user_id' => $userId])->all();
    $result = [];
    if (!empty($dataList)) {
        foreach ($dataList as $dataItem) {
            $result[$dataItem->id] = ['a' => $dataItem->a, 'b' => $dataItem->b];
        }
    }

    return $result;
}
```

### 3
Схематично описать структуру таблиц для хранения информации о медикаментах
со следующими требованиями: лекарство имеет название, срок годности и список
болезней, при которых это лекарство можно применять.

![Image database structure](https://i.imgur.com/7GbqAey.png)

### 4
При заходе на любую страницу из браузера необходимо выполнять определенную
последовательность действий перед отображением содержимого. Как это лучше
реализовать?

Я вижу несколько вариатов
1. Middleware
2. Events (события)

