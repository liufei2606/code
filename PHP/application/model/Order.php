<?php
namespace Application\services\Model;

class Order
{
    /**
     * @var DbDrive
     */
    private $db;

    /**
     * Order constructor.
     *
     * @param DbDrive $driver
     */
    public function __construct(DbDrive $driver)
    {
        $this->db = $driver;
    }

    public function add()
    {
        //TODO::订单业务
        $this->db->insert();//执行入库操作
    }
}

$db = new MysqlDb();//创建一个依赖
$order = new Order($db);//将需要依赖的对象通过构造函数传递进去
$order->add();//正常的去调用业务
