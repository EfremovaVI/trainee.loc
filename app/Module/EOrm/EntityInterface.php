<?php
/**
 * Project: CGI Trainee
 * User: Evi
 * email: efremova.vasilina@mail.ru
 */
namespace Cgi\Module\EOrm;

interface EntityInterface
{
    /**
     * Returns the attribute data based on the primary key of the previously
     * downloaded object.
     *
     * @param $attribute
     *
     * @return
     */
    public function get($attribute);

    /**
     * Adding data to create or update the object data.
     * If creation is successful, return true.
     *
     * @param $attribute
     * @param $value
     *
     * @return
     */
    public function set($attribute, $value);

    /**
     * Creates or Updates an object.
     * If creation is successful, return true.
     */
    public function save();

    /**
     * Delete previously downloaded object
     * If deletion is successful, return true.
     */
    public function delete();

    /**
     * Returns the data model based on the primary key.
     *
     * @param $id
     *
     * @return
     */
    public function load($id);
}