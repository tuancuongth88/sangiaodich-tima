<?php

/**
 *
 */
interface Base {

    /**
     * @return [type]
     */
    public function getInputFieldStore();

    public function store();

    public function getInputFieldUpdate();

    public function show($id);

    public function update($id);

    public function delete($id);
}