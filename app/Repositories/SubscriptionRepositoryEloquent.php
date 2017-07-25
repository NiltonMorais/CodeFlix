<?php

namespace CodeFlix\Repositories;

use Carbon\Carbon;
use CodeFlix\Models\Plan;
use CodeFlix\Repositories\Interfaces\PlanRepository;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeFlix\Repositories\Interfaces\SubscriptionRepository;
use CodeFlix\Models\Subscription;
use CodeFlix\Validators\SubscriptionsValidator;

/**
 * Class SubscriptionsRepositoryEloquent
 * @package namespace CodeFlix\Repositories;
 */
class SubscriptionRepositoryEloquent extends BaseRepository implements SubscriptionRepository
{
    public function create(array $attributes)
    {
        $planRepository = app(PlanRepository::class);
        $plan = $planRepository->find($attributes['plan_id']);
        $attributes['expires_at'] = $this->calculateExpiresAt($plan);
        return parent::create($attributes);
    }

    private function calculateExpiresAt(Plan $plan)
    {
        if($plan->duration == Plan::DURATION_MONTHLY){
            return (new Carbon())->addMonth(1)->format('Y-m-d');
        }else{
            return (new Carbon())->addYear(1)->format('Y-m-d');
        }
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Subscription::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
