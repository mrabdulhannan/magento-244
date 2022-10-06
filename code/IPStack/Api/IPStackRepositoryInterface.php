<?php

namespace Firewalls\IPStack\Api;

use Firewalls\IPStack\Api\Data\IPStackApiInterface;

interface IPStackRepositoryInterface
{
    /**
     * @param IPStackApiInterface $IPStackApiInterface
     * @return mixed
     */
    public function save(IPStackApiInterface $IPStackApiInterface);

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id);

    /**
     * @param IPStackApiInterface $IPStackApiInterface
     * @return mixed
     */
    public function delete(IPStackApiInterface $IPStackApiInterface);

    /**
     * @param $id
     * @return mixed
     */
    public function deleteById($id);
}