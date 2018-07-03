<?php

namespace Repositories;


/**
 * Manage all Section Table custom Operations
 *
 * @author yasser.mohamed
 */
class SubjectRepository extends BaseRepository
{

    /**
     * Determine the model of the repository
     *
     */
    public function model()
    {
        return 'Models\Subject';
    }
}