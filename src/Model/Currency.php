<?php

namespace Bonuses\Model;


class Currency
{
    const TYPE_USD = 1;

    protected static $names = [
        self::TYPE_USD => 'USD',
    ];

    protected $formatPatterns = [
        self::TYPE_USD => '$%s',
    ];

    protected $id;

    public function __construct(int $id)
    {
        $this->id = $id;

        if (!isset(self::$names[$this->id])) {
            throw new \Exception('Unknown currency ID: ' . $this->id);
        }
    }

    /**
     * Creates currency by id
     *
     * @param $id
     * @return Currency
     * @throws \Exception
     */
    public static function fromId($id)
    {
        return new self($id);
    }

    /**
     * Creates currency by name
     *
     * @param $name
     * @return Currency
     * @throws \Exception
     */
    public static function fromName($name)
    {
        $id = array_search(strtoupper($name), self::$names);
        if (!$id) {
            throw new \Exception('Unknown currency name: ' . $name);
        }

        return new self($id);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Name of currency
     *
     * @return string
     */
    public function getName(): string
    {
        return self::$names[$this->id];
    }

    /**
     * Formats money with current currency
     *
     * @param Money $amount
     * @return string
     */
    public function formatMoney(Money $amount): string
    {
        return sprintf(
            $this->formatPatterns[$this->id],
            number_format($amount->getHumanReadableAmount(), $amount->getPrecision(), ',', '')
        );
    }
}