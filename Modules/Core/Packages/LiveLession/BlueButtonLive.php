<?php
namespace Modules\Core\Packages\LiveLession;

use BigBlueButton\Parameters\JoinMeetingParameters;
use Modules\Core\Packages\LiveLession\LiveInterface;
use JoisarJignesh\Bigbluebutton\Facades\Bigbluebutton;

class BlueButtonLive implements LiveInterface
{
    public function createMetting($lesson)
    {
        $checkRunning = Bigbluebutton::isMeetingRunning("ilearn-".$lesson->id);
        if ($checkRunning) {
            return [];
        }
        $createMeeting = Bigbluebutton::initCreateMeeting([
            'meetingID' => "ilearn-".$lesson->id,
            'meetingName' => $lesson->title ?? __("learn::api.lesson.title") ,
            'attendeePW' => 'student',
            'moderatorPW' => 'teacher',
        ]);
        $duration = $lesson->end_at->diffInMinutes(now());
        $createMeeting
        ->setDuration($duration)
        ->setRecord(false)
        ->setMuteOnStart(true)
        ->setAllowStartStopRecording(true)
        ->setAllowModsToUnmuteUsers(true)
        // ->setEndCallbackUrl()
        ->setLogoutUrl(config("bigbluebutton.logut_url", url("/")))
        // ->setRecordingReadyCallbackUrl(route( config("blueButton.endRecordCallback") ) )
        ;
        return Bigbluebutton::create($createMeeting);
    }

    public function forceClose($lesson)
    {
        Bigbluebutton::close(["meetingID"=>"ilearn-".$lesson->id, "moderatorPW"=>config("bigbluebutton.teacher_code")]);
    }


    public function joinApi($lesson, $is_teacher=true)
    {
        // $this->forceClose($lesson);
        $this->createMetting($lesson);
        $joinParmater = $is_teacher ? $this->joinTeacher($lesson) :  $this->joinStudent($lesson);

        // dd($joinParmater);
        $url = Bigbluebutton::join($joinParmater);
        return $url;
    }

    public function joinTeacher($lesson, $redirect=false)
    {
        $joinParmater = new JoinMeetingParameters("ilearn-".$lesson->id, $lesson->teacher->name, config("bigbluebutton.teacher_code")) ;

        $joinParmater->setRedirect($redirect, $redirect)
                     ->setUserId($lesson->teacher->id)
                     ->addUserData("bbb_skip_check_audio",true)
                     ->addUserData("bbb_client_title",$lesson->title ?? __("learn::api.lesson.title"))
                     ;
        return $joinParmater      ;
    }

    public function joinStudent($lesson, $redirect=false)
    {
        $joinParmater = new JoinMeetingParameters("ilearn-".$lesson->id, $lesson->student->name, config("bigbluebutton.student_code")) ;

        $joinParmater->setRedirect($redirect)
                     ->setUserId($lesson->student->id)
                     ->addUserData("bbb_skip_check_audio",true)
                     ->addUserData("bbb_auto_join_audio",false)
                     ->addUserData("bbb_client_title",$lesson->title ?? __("learn::api.lesson.title"))
                     ;
        return $joinParmater ;
    }
}
