<?php

namespace Tungltdev\Firebase\Tests\Fixtures;

use Illuminate\Database\Eloquent\Model;
use Tungltdev\Firebase\SyncsWithFirebase;

class User extends Model
{

    use SyncsWithFirebase;
}
