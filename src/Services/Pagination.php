<?php


namespace App\Services;

class Pagination
{

    /** @var int  */
    protected int $limit;

    /** @var array  */
    protected array $data;

    /** @var int  */
    protected int $offset;

    /**
     * Pagination constructor.
     * @param int $limit
     * @param array $data
     * @param int $offset
     */
    public function __construct(int $limit, array $data, int $offset)
    {
        $this->limit = $limit;
        $this->data = $data;
        $this->offset = $offset;
    }

    /**
     * @return int
     */
    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * @return int
     */
    public function getPages(): int
    {
        $count = count($this->data);

        return (int)ceil($count / $this->limit);
    }
}
