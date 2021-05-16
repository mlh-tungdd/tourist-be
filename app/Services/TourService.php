<?php

namespace App\Services;

use App\Models\Tour;
use Illuminate\Database\Eloquent\Builder;

class TourService implements TourServiceInterface
{
    protected $tour;

    public function __construct(Tour $tour)
    {
        $this->tour = $tour;
    }

    /**
     * get list
     *
     * @return void
     */
    public function getListTour($params)
    {
        $query = $this->tour->with(['time', 'departure', 'destination'])->orderByDesc('created_at');
        $title = $params['title'] ?? null;
        $rollNumber = $params['roll_number'] ?? null;
        $timeId = $params['time_id'] ?? null;
        $departureId = $params['departure_id'] ?? null;
        $destinationId = $params['destination_id'] ?? null;

        if ($title != null) {
            $query->where('title', 'like', '%' . $title . '%');
        }

        if ($rollNumber != null) {
            $query->where('roll_number', $rollNumber);
        }

        if ($timeId != null) {
            $query->where('time_id', $timeId);
        }

        if ($departureId != null) {
            $query->where('departure_id', $departureId);
        }

        if ($destinationId != null) {
            $query->where('destination_id', $destinationId);
        }

        $active = $params['active'] ?? null;
        if ($active != null) {
            $query->where('active', $active);
        }

        $query = $query->paginate();

        return [
            'data' => $query->map(function ($item) {
                return $item->getTourResponse();
            }),
            'per_page' => $query->perPage(),
            'total' => $query->total(),
            'current_page' => $query->currentPage(),
            'last_page' => $query->lastPage(),
        ];
    }

    /**
     * get all
     *
     * @return void
     */
    public function getAllTour($params)
    {
        $query = null;
        /**
         * type
         * - hot_sale
         * - last_hour
         * locale
         * - nation
         * - foreign
         */
        $type = $params['type'] ?? null;
        $locale = $params['locale'] ?? null;
        $mostView = $params['views'] ?? null;
        $detail = $params['detail'] ?? null;
        $now = now();
        $lastDay = $now->addDay();
        $active = $params['active'] ?? null;

        if ($mostView == null) {
            $query = $this->tour->orderByDesc('created_at');
        } else {
            $query = $this->tour->orderByDesc('views')
                ->where('views', '!=', 0);
        }

        if ($active != null) {
            $query->where('active', $active);
        }

        if ($type != null) {
            switch ($type) {
                case 'hot_sale':
                    $query->whereHas('tourPrices', function (Builder $q) {
                        $q->where('original_price', '!=', 0)
                            ->whereColumn('price', '<', 'original_price');
                    });
                    break;
                case 'last_hour':
                    $query->whereHas('tourDepartures', function ($q) use ($lastDay) {
                        $q->where('start_day', '<=', $lastDay);
                    });
                    break;
                default:
                    //
                    break;
            }
        }

        if ($locale != null) {
            switch ($locale) {
                case 'nation':
                    $query->whereHas('destination', function ($q) {
                        $q->where('type', 0);
                    });
                    break;
                case 'foreign':
                    $query->whereHas('destination', function ($q) {
                        $q->where('type', 1);
                    });
                    break;
                default:
                    //
                    break;
            }
        }

        if ($type != null || $locale != null) {
            $query->whereHas('tourDepartures', function ($q) use ($now) {
                $q->where('start_day', '>', $now);
            });
            if ($detail == null) {
                $query = $query->limit(10)->get();
            } else {
                $query = $query->paginate();
                return [
                    'data' => $query->map(function ($item) {
                        return $item->getTourResponse();
                    }),
                    'per_page' => $query->perPage(),
                    'total' => $query->total(),
                    'current_page' => $query->currentPage(),
                    'last_page' => $query->lastPage(),
                ];
            }
        } else {
            $query = $query->get();
        }

        return $query->map(function ($item) {
            return $item->getTourResponse();
        });
    }

    /**
     * create
     *
     * @param array $params
     * @return void
     */
    public function createTour($params)
    {
        $this->tour->create([
            'roll_number' => $params['roll_number'],
            'title' => $params['title'],
            'description' => $params['description'],
            'content' => $params['content'],
            'schedule' => $params['schedule'],
            'term' => $params['term'],
            'thumbnail' => $params['thumbnail'],
            'space' => $params['space'],
            'time_id' => $params['time_id'],
            'vehicle' => $params['vehicle'],
            'departure_id' => $params['departure_id'],
            'destination_id' => $params['destination_id'],
            'active' => $params['active'],
        ]);
    }

    /**
     * delete
     *
     * @param $id
     * @return void
     */
    public function deleteTour($id)
    {
        $this->tour->findOrFail($id)->delete();
    }

    /**
     * show
     *
     * @param $id
     * @return void
     */
    public function showTour($id)
    {
        return $this->tour->findOrFail($id)->getTourResponse();
    }

    /**
     * edit
     *
     * @param array $params
     * @return void
     */
    public function updateTour($params)
    {
        $this->tour->findOrFail($params['id'])->update($params);
    }

    /**
     * getListTourByLocationId
     */
    public function getListTourByLocationId($params)
    {
        $id = $params['id'];
        $tourId = $params['tourId'] ?? null;
        $now = now();
        $query = $this->tour->where('active', 1)->where('destination_id', $id)->orderByDesc('created_at')
            ->whereHas('tourDepartures', function ($q) use ($now) {
                $q->where('start_day', '>', $now);
            });

        if ($tourId != null) {
            $query->where('id', '!=', $tourId);
        }

        $query = $query->paginate();

        return [
            'data' => $query->map(function ($item) {
                return $item->getTourResponse();
            }),
            'per_page' => $query->perPage(),
            'total' => $query->total(),
            'current_page' => $query->currentPage(),
            'last_page' => $query->lastPage(),
        ];
    }

    /**
     * filterTour
     */
    public function filterTour($params)
    {
        $locale = $params['locale'] ?? null;
        $departure = $params['departure'] ?? null;
        $destination = $params['destination'] ?? null;
        $start = $params['start'] ?? null;
        $time = $params['time'] ?? null;
        $price = $params['price'] ?? null;

        $now = now();
        $query = $this->tour->orderByDesc('created_at');
        $query->whereHas('tourDepartures', function ($q) use ($now) {
            $q->where('start_day', '>', $now);
        });
        if ($locale != null) {
            $query->whereHas('destination', function ($q) use ($locale) {
                $q->where('type', $locale);
            });
        }
        if ($departure != null) {
            $query->whereHas('departure', function ($q) use ($departure) {
                $q->where('id', $departure);
            });
        }
        if ($destination != null) {
            $query->whereHas('destination', function ($q) use ($destination) {
                $q->where('id', $destination);
            });
        }
        if ($time != null) {
            $query->whereHas('time', function ($q) use ($time) {
                $q->where('id', $time);
            });
        }
        if ($start != null) {
            $query->whereHas('tourDepartures', function ($q) use ($start) {
                $q->where('start_day', $start);
            });
        }
        $active = $params['active'] ?? null;
        if ($active != null) {
            $query->where('active', $active);
        }

        $query = $query->paginate();
        return [
            'data' => $query->map(function ($item) {
                return $item->getTourResponse();
            }),
            'per_page' => $query->perPage(),
            'total' => $query->total(),
            'current_page' => $query->currentPage(),
            'last_page' => $query->lastPage(),
        ];
    }
}
