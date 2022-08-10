<?php

/*
 * This file is part of Laravel WuBook.
 *
 * (c) Filippo Galante <filippo.galante@b-ground.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AND48\LaravelWubook\Api;

use Carbon\Carbon;

/**
 * Description of WuBookRestrictions
 *
 * @author Filippo Galante <filippo.galante@b-ground.com>
 */
class WuBookRestrictions extends WuBookApi
{

    /**
     * https://tdocs.wubook.net/wired/rstrs.html#rplan_add_rplan
     *
     * @param string $name
     * @param int $compact 0|1
     * @return mixed
     */
    public function rplan_add_rplan(string $name, int $compact = 0)
    {
        return $this->call_method('rplan_add_rplan', [$name, $compact]);
    }

    /**
     * https://tdocs.wubook.net/wired/rstrs.html#rplan_rplans
     *
     * @return mixed
     */
    public function rplan_rplans()
    {
        return $this->call_method('rplan_rplans');
    }

    /**
     * https://tdocs.wubook.net/wired/rstrs.html#rplan_del_rplan
     *
     * @param int $id
     * @return mixed
     */
    public function rplan_del_rplan(int $id)
    {
        return $this->call_method('rplan_del_rplan', [$id]);
    }

    /**
     * https://tdocs.wubook.net/wired/rstrs.html#rplan_rename_rplan
     *
     * @param int $id
     * @param string $name
     * @return mixed
     */
    public function rplan_rename_rplan(int $id, string $name)
    {
        return $this->call_method('rplan_rename_rplan', [$id, $name]);
    }

    /**
     * https://tdocs.wubook.net/wired/rstrs.html#rplan_update_rplan_values
     *
     * @param int $id
     * @param Carbon $dfrom
     * @param object $values
     * @return mixed
     */
    public function rplan_update_rplan_values(int $id, Carbon $dfrom, object $values)
    {
        return $this->call_method('rplan_update_rplan_values', [$id, $this->formatDate($dfrom), $values]);
    }

    /**
     * https://tdocs.wubook.net/wired/rstrs.html#rplan_get_rplan_values
     *
     * @param Carbon $dfrom
     * @param Carbon $dto
     * @param array $rpids
     * @return mixed
     */
    public function rplan_get_rplan_values(Carbon $dfrom, Carbon $dto, array $rpids = [])
    {
        return $this->call_method('rplan_get_rplan_values', [$this->formatDate($dfrom), $this->formatDate($dto), $rpids]);
    }
}
