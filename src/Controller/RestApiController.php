<?php
// src/Controller/RestApiController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;

use App\Entity\DcCapacity;
use App\Entity\DcNodesStatus;
use App\Entity\DcEnvironment;
use App\Entity\DcNetwork;
use App\Entity\DcThresholds;

use App\Repository\DcCapacityRepository;
use App\Repository\DcEnvironmentRepository;
use App\Repository\DcNodesStatusRepository;
use App\Repository\DcNetworkRepository;
use App\Repository\DcThresholdsRepository;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
// use Symfony\Component\HttpFoundation\Response;
// use Symfony\Component\Serializer\Serializer;
// use Symfony\Component\Serializer\Encoder\XmlEncoder;
// use Symfony\Component\Serializer\Encoder\JsonEncoder;
// use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class RestApiController extends ApiController
{   

    /**
    * @Route("/api/nodes")
    */
    public function nodeapi(Request $request, DcThresholdsRepository $DcThresholdsRepository)
    {
        $key = $request->attributes->get('key');
        if ($key !== 'RtasGhj890AsQwSd') {
            return $this->keyerror();
        }
        // For get data from api
        $url = "https://capacity.threefoldtoken.com/api/nodes?farmer=mazraa";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL,$url);
        $result=curl_exec($ch);
        curl_close($ch);
        $data = json_decode($result);

        // Variable declared for total resources
        $total_resource_cru = 0;
        $total_resource_mru = 0;
        $total_resource_hru = 0;
        $total_resource_sru = 0;

        // Variable declared for reserved resources
        $reserved_resources_cru = 0;
        $reserved_resources_mru = 0;
        $reserved_resources_hru = 0;
        $reserved_resources_sru = 0;

        // Variable declared for used resources
        $used_resources_cru = 0;
        $used_resources_mru = 0;
        $used_resources_hru = 0;
        $used_resources_sru = 0;

        // array declaration for robot address
        $robot_address = array();
        // $free_cru_table = array();
        $getupdatednodes     = array();
        foreach ($data as $key => $value) {

            if ( strtotime($value->updated)  > strtotime('-30 days') ) {
                // For total resources
                $total_resource_cru = $total_resource_cru + (!empty($value->total_resources->cru) ? $value->total_resources->cru : 0);
                $total_resource_mru = $total_resource_mru  + (!empty($value->total_resources->mru) ? $value->total_resources->mru : 0);
                $total_resource_hru = $total_resource_hru + (!empty($value->total_resources->hru) ? $value->total_resources->hru : 0);
                $total_resource_sru = $total_resource_sru + (!empty($value->total_resources->sru) ? $value->total_resources->sru : 0);
                // For reserved resources
                $reserved_resources_cru = $reserved_resources_cru + (!empty($value->reserved_resources->cru) ? $value->reserved_resources->cru : 0);
                $reserved_resources_mru = $reserved_resources_mru + (!empty($value->reserved_resources->mru) ? $value->reserved_resources->mru : 0);
                $reserved_resources_hru = $reserved_resources_hru + (!empty($value->reserved_resources->hru) ? $value->reserved_resources->hru : 0);
                $reserved_resources_sru = $reserved_resources_sru + (!empty($value->reserved_resources->sru) ? $value->reserved_resources->sru : 0);
                // For used resources
                $used_resources_cru = $used_resources_cru + (!empty($value->used_resources->cru) ? $value->used_resources->cru : 0);
                $used_resources_mru = $used_resources_mru + (!empty($value->used_resources->mru) ? $value->used_resources->mru : 0);
                $used_resources_hru = $used_resources_hru + (!empty($value->used_resources->hru) ? $value->used_resources->hru : 0);
                $used_resources_sru = $used_resources_sru + (!empty($value->used_resources->sru) ? $value->used_resources->sru : 0);
                $getupdatednodes[strtotime($value->updated)][] = $value;
            }
        }
        krsort($getupdatednodes);
        $online = array();
        foreach ($getupdatednodes as $key => $value) {
            
            if (count($value) == 1) {
              $online[] = $value[0];
            }else{
              
                foreach ($value as $subkey => $subvalue) {
                    $online[] = $subvalue;
                }
            }
        }
        
        // Free resources
        $free_cru = $total_resource_cru-$used_resources_cru > 0 ? $total_resource_cru-$used_resources_cru : 0;
        $free_mru = $total_resource_mru-$used_resources_mru > 0 ? $total_resource_mru-$used_resources_mru : 0;
        $free_hru = $total_resource_hru-$used_resources_hru > 0 ? $total_resource_hru-$used_resources_hru : 0;
        $free_sru = $total_resource_sru-$used_resources_sru > 0 ? $total_resource_sru-$used_resources_sru : 0; 

        $last_updated_time = current($online)->updated;
        
        /*DcThresholdsRepository singal data*/
        $getthreshold   = $DcThresholdsRepository->findOneBySomeField();

        // Send farm section values 
        $farm_values = array(
            'total_cru'             => $total_resource_cru,
            'total_mru'             => $total_resource_mru,
            'total_hru'             => $total_resource_hru/1024,
            'total_sru'             => $total_resource_sru/1024,
            'free_cru'              => $free_cru,
            'free_mru'              => $free_mru,
            'free_hru'              => $free_hru/1024,
            'free_sru'              => $free_sru/1024,
            'used_cru'              => $used_resources_cru,
            'used_mru'              => $used_resources_mru,
            'used_hru'              => $used_resources_hru/1024,
            'used_sru'              => $used_resources_sru/1024,
            'last_updated_time'     => $last_updated_time,
            'data'                  => $online,
            'online'                => count($online),
            'offline'               => $getthreshold->getGridNodeCount()-count($online)
        );
        return new JsonResponse($farm_values);
    }

    /**
    * @Route("/api/update/nodes", methods="GET")
    */
    public function update_nodes(Request $request,DcCapacityRepository $DcCapacityRepository,  EntityManagerInterface $entity, DcThresholdsRepository $DcThresholdsRepository)
    {   
        $key = $request->attributes->get('key');
        if ($key !== 'RtasGhj890AsQwSd') {
            return $this->keyerror();
        }
        // For get data from api
        $url    =   "https://capacity.threefoldtoken.com/api/nodes?farmer=mazraa";
        $ch     =   curl_init();
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_URL,$url);
        $result =   curl_exec($ch);
                    curl_close($ch);
        $data   = (array) json_decode($result);
       
        $message    = array();
        $getupdatednodes     = array();
        foreach ($data as $value) {

            // total resources
            $total_resource_cru = !empty($value->total_resources->cru) ? $value->total_resources->cru : 0;
            $total_resource_mru = !empty($value->total_resources->mru) ? $value->total_resources->mru : 0;
            $total_resource_hru = !empty($value->total_resources->hru) ? $value->total_resources->hru : 0;
            $total_resource_sru = !empty($value->total_resources->sru) ? $value->total_resources->sru : 0;
            // free resources
            $free_cru = $total_resource_cru - (isset($value->used_resources) ? $value->used_resources->cru : 0);
            $free_mru = $total_resource_mru - (isset($value->used_resources) ? $value->used_resources->mru : 0);
            $free_hru = $total_resource_hru - (isset($value->used_resources) ? $value->used_resources->hru : 0);
            $free_sru = $total_resource_sru - (isset($value->used_resources) ? $value->used_resources->sru : 0);
            
            $checknode = $DcCapacityRepository->findOneBy( array( 'node_id' => $value->node_id ) );
            if ($checknode == null && empty($checknode)) {

                // persist the new nodes
                $DcCapacity = new DcCapacity;
                $DcCapacity->setCruTotal($total_resource_cru);
                $DcCapacity->setMruTotal($total_resource_mru);
                $DcCapacity->setHruTotal($total_resource_hru);
                $DcCapacity->setSruTotal($total_resource_sru);
                $DcCapacity->setCruFree($free_cru);
                $DcCapacity->setMruFree($free_mru);
                $DcCapacity->setHruFree($free_hru);
                $DcCapacity->setSruFree($free_sru);
                $DcCapacity->setNodeId($value->node_id);
                $DcCapacity->setLastUpdate( new \DateTime('@'.strtotime($value->updated)) );

                $entity->persist($DcCapacity);
                if ($entity->flush()) {
                    
                    $message[] = array('status' => 'error','node_id' => $value->node_id);
                }else{
                    $message[] = array('status' => 'success','node_id' => $value->node_id);
                }
            }else{
                $checknode->setCruTotal($total_resource_cru);
                $checknode->setMruTotal($total_resource_mru);
                $checknode->setHruTotal($total_resource_hru);
                $checknode->setSruTotal($total_resource_sru);
                $checknode->setCruFree($free_cru);
                $checknode->setMruFree($free_mru);
                $checknode->setHruFree($free_hru);
                $checknode->setSruFree($free_sru);
                $checknode->setNodeId($value->node_id);
                $checknode->setLastUpdate( new \DateTime('@'.strtotime($value->updated)) );
                $entity->merge($checknode);
                if ($entity->flush()) {
                    
                    $message[] = array('status' => 'error','node_id' => $value->node_id);
                }else{
                    $message[] = array('status' => 'success','node_id' => $value->node_id);
                }
            }
            
            if ( strtotime($value->updated)  > strtotime('-30 days') ) {
               $getupdatednodes[strtotime($value->updated)][] = $value;
            }

        }
        krsort($getupdatednodes);
        
        $online = array();
        foreach ($getupdatednodes as $key => $value) {
            
            if (count($value) == 1) {
              $online[] = $value[0];
            }else{
              
                foreach ($value as $subkey => $subvalue) {
                    $online[] = $subvalue;
                }
            }
        }

        $last_updated_time = current($online)->updated;

        /*DcThresholdsRepository singal data*/
        $getthreshold   = $DcThresholdsRepository->findOneBySomeField();

        $DcNodesStatus = new DcNodesStatus;
        $DcNodesStatus->setNodesOnline(count($online));
        $DcNodesStatus->setNodesOffline($getthreshold->getGridNodeCount()-count($online));
        // $DcNodesStatus->setLastUpdate( new \DateTime() );
        $entity->persist($DcNodesStatus);
        $entity->flush();

        return new JsonResponse($message);
    }

    /**
    * @Route("/api/update/environment", methods="GET")
    */
    public function update_environment(Request $request, DcEnvironmentRepository $DcEnvironmentRepository, EntityManagerInterface $entity)
    {   
        $key = $request->attributes->get('key');
        if ($key !== 'RtasGhj890AsQwSd') {
            return $this->keyerror();
        }
        // For get data from api
        $url    =   "http://api.ubibot.io/channels/1406?account_key=860a553576d7dea6d511bf67b565f1b8";
        $ch     =   curl_init();
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_URL,$url);
        $result =   curl_exec($ch);
                    curl_close($ch);
        $data   =   json_decode($result);
        
        $envresult = '';

        if ($data->result == 'success' ) {
            $envresult = $data->channel->last_values;
        }else{
            $url    =   "http://api.ubibot.io/channels/1405?account_key=860a553576d7dea6d511bf67b565f1b8";
            $ch     =   curl_init();
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_URL,$url);
            $result =   curl_exec($ch);
                        curl_close($ch);
            $data   =   json_decode($result);
            if ($data->result == 'success' ) {
                $envresult = $data->channel->last_values;
            }
        }
        $message = array();
        $envresult = json_decode($envresult);
        
        $checknode = $DcEnvironmentRepository->findOneBy( array( 
                                                                    'envTemp' => $envresult->field1->value ,
                                                                    'envHumidity' => $envresult->field2->value ,
                                                                    'envLight' => $envresult->field3->value 
                                                                ) 
                                                        );
        if ($checknode == null && empty($checknode)) {
        
            $DcEnvironment = new DcEnvironment;
            $DcEnvironment->setEnvTemp($envresult->field1->value);
            $DcEnvironment->setEnvHumidity($envresult->field2->value);
            $DcEnvironment->setEnvLight($envresult->field3->value);
            // $DcEnvironment->setEnvLastUpdate( new \DateTime() );
            $entity->persist($DcEnvironment);
            if ($entity->flush()) {
                $message[] = array('status' => 'error');
            }else{
                $message[] = array('status' => 'success');
            }
        }else{
            $checknode->setEnvTemp($envresult->field1->value);
            $checknode->setEnvHumidity($envresult->field2->value);
            $checknode->setEnvLight($envresult->field3->value);
            $entity->merge($checknode);
            if ($entity->flush()) {
                $message[] = array('status' => 'error');
            }else{
                $message[] = array('status' => 'success');
            }
        }
        return new JsonResponse($message);
    }
   
    /**
    * @Route("/api/get/environment", methods="GET")
    */
    public function get_environment(Request $request, DcEnvironmentRepository $DcEnvironmentRepository, EntityManagerInterface $entity)
    {   
        $key = $request->attributes->get('key');
        if ($key !== 'RtasGhj890AsQwSd') {
            return $this->keyerror();
        }
        // For get data from api
        $url    =   "http://api.ubibot.io/channels/1406?account_key=860a553576d7dea6d511bf67b565f1b8";
        $ch     =   curl_init();
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_URL,$url);
        $result =   curl_exec($ch);
                    curl_close($ch);
        $data   =   json_decode($result);
        
        $envresult = '';

        if ($data->result == 'success' ) {
            $envresult = $data->channel->last_values;
        }else{
            $url    =   "http://api.ubibot.io/channels/1405?account_key=860a553576d7dea6d511bf67b565f1b8";
            $ch     =   curl_init();
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_URL,$url);
            $result =   curl_exec($ch);
                        curl_close($ch);
            $data   =   json_decode($result);
            if ($data->result == 'success' ) {
                $envresult = $data->channel->last_values;
            }
        }
        $message = array();
        $envresult = json_decode($envresult);

        $checknode = $DcEnvironmentRepository->findOneBy( array( 
                                                                    'envTemp' => $envresult->field1->value ,
                                                                    'envHumidity' => $envresult->field2->value ,
                                                                    'envLight' => $envresult->field3->value 
                                                                ) 
                                                      );
        
        if ($checknode == null && empty($checknode)) {
        
            $DcEnvironment = new DcEnvironment;
            $DcEnvironment->setEnvTemp($envresult->field1->value);
            $DcEnvironment->setEnvHumidity($envresult->field2->value);
            $DcEnvironment->setEnvLight($envresult->field3->value);
            $entity->persist($DcEnvironment);
            if ($entity->flush()) {
                $message[] = array('status' => 'error');
            }else{
                $message[] = array('status' => 'success');
            }
        }else{
            $checknode->setEnvTemp($envresult->field1->value);
            $checknode->setEnvHumidity($envresult->field2->value);
            $checknode->setEnvLight($envresult->field3->value);
            $entity->merge($checknode);
            if ($entity->flush()) {
                $message[] = array('status' => 'error');
            }else{
                $message[] = array('status' => 'success');
            }
        }

        $todayenvironment = $DcEnvironmentRepository->get_environment();
        $H1H = array();
        $H2H = array();
        $H3H = array();
        $H4H = array();
        $H5H = array();
        $H6H = array();
        $H7H = array();
        $H8H = array();
        $H9H = array();
        $H10H = array();
        $H11H = array();
        $H12H = array();
        $H13H = array();
        $H14H = array();
        $H15H = array();
        $H16H = array();
        $H17H = array();
        $H18H = array();
        $H19H = array();
        $H20H = array();
        $H21H = array();
        $H22H = array();
        $H23H = array();
        $H24H = array();
        $updatedata=array();
        foreach($todayenvironment as $environment) {
            $hours = $environment->getEnvLastUpdate()->format('H');
            $getTimestamp = $environment->getEnvLastUpdate()->getTimestamp();

            $environment_new = array(
                                'envID' => $environment->getEnvID(),
                                'envTemp' => number_format($environment->getEnvTemp(),2),
                                'envHumidity' => number_format($environment->getEnvHumidity(),2),
                                'envLight' => number_format($environment->getEnvLight(),2),
                                'envLastUpdate' => $environment->getEnvLastUpdate()->format('F j, Y, g:i a'),
                            );
            if ($hours == '00') {
                $H1H[$getTimestamp] = $environment_new;
            }elseif ($hours == '01') {
                $H2H[$getTimestamp] = $environment_new;
            }elseif ($hours == '02') {
                $H3H[$getTimestamp] = $environment_new;
            }elseif ($hours == '03') {
                $H4H[$getTimestamp] = $environment_new;
            }elseif ($hours == '04') {
                $H5H[$getTimestamp] = $environment_new;
            }elseif ($hours == '05') {
                $H6H[$getTimestamp] = $environment_new;
            }elseif ($hours == '06') {
                $H7H[$getTimestamp] = $environment_new;
            }elseif ($hours == '07') {
                $H8H[$getTimestamp] = $environment_new;
            }elseif ($hours == '08') {
                $H9H[$getTimestamp] = $environment_new;
            }elseif ($hours == '09') {
                $H10H[$getTimestamp] = $environment_new;
            }elseif ($hours == '10') {
                $H11H[$getTimestamp] = $environment_new;
            }elseif ($hours == '11') {
                $H12H[$getTimestamp] = $environment_new;
            }elseif ($hours == '12') {
                $H13H[$getTimestamp] = $environment_new;
            }elseif ($hours == '13') {
                $H14H[$getTimestamp] = $environment_new;
            }elseif ($hours == '14') {
                $H15H[$getTimestamp] = $environment_new;
            }elseif ($hours == '15') {
                $H16H[$getTimestamp] = $environment_new;
            }elseif ($hours == '16') {
                $H17H[$getTimestamp] = $environment_new;
            }elseif ($hours == '17') {
                $H18H[$getTimestamp] = $environment_new;
            }elseif ($hours == '18') {
                $H19H[$getTimestamp] = $environment_new;
            }elseif ($hours == '19') {
                $H20H[$getTimestamp] = $environment_new;
            }elseif ($hours == '20') {
                $H21H[$getTimestamp] = $environment_new;
            }elseif ($hours == '21') {
                $H22H[$getTimestamp] = $environment_new;
            }elseif ($hours == '22') {
                $H23H[$getTimestamp] = $environment_new;
            }elseif ($hours == '23') {
                $H24H[$getTimestamp] = $environment_new;
            }
            $updatedata[$getTimestamp] = $environment_new;
        }
        
        krsort($H1H);krsort($H2H);krsort($H3H);krsort($H4H);krsort($H5H);krsort($H6H);krsort($H7H);krsort($H8H);krsort($H9H);krsort($H10H);
        krsort($H11H);krsort($H12H);krsort($H13H);krsort($H14H);krsort($H15H);krsort($H16H);krsort($H17H);krsort($H18H);krsort($H19H);krsort($H20H);
        krsort($H21H);krsort($H22H);krsort($H23H);krsort($H24H);
        krsort($updatedata);
        $farm_values = array(
            'H1H' => current($H1H),
            'H2H' => current($H2H),
            'H3H' => current($H3H),
            'H4H' => current($H4H),
            'H5H' => current($H5H),
            'H6H' => current($H6H),
            'H7H' => current($H7H),
            'H8H' => current($H8H),
            'H9H' => current($H9H),
            'H10H' => current($H10H),
            'H11H' => current($H11H),
            'H12H' => current($H12H),
            'H13H' => current($H13H),
            'H14H' => current($H14H),
            'H15H' => current($H15H),
            'H16H' => current($H16H),
            'H17H' => current($H17H),
            'H18H' => current($H18H),
            'H19H' => current($H19H),
            'H20H' => current($H20H),
            'H21H' => current($H21H),
            'H22H' => current($H22H),
            'H23H' => current($H23H),
            'H24H' => current($H24H),
            'updatedata' => current($updatedata)
        );
        return new JsonResponse($farm_values);
    }
    /**
    * @Route("/api/get/network", methods="GET")
    */
    public function get_network(Request $request, DcNetworkRepository $DcNetworkRepository, DcThresholdsRepository $DcThresholdsRepository)
    {   
        $key = $request->attributes->get('key');
        if ($key !== 'RtasGhj890AsQwSd') {
            return $this->keyerror();
        }
        $getthreshold   = $DcThresholdsRepository->findOneBySomeField();
        $getnetwork     = $DcNetworkRepository->findOneBySomeField();
        $network_json = array(  
                                'wan_min_down' => $getthreshold->getWanMinDown(),
                                'wan_min_up' => $getthreshold->getWanMinUp(),
                                'lan_min_throughput' => $getthreshold->getLanMinThroughput(),
                                'id' => $getnetwork->getId(),
                                'wan_up' => $getnetwork->getWanUp(),
                                'wan_down' => $getnetwork->getWanDown(),
                                'lan_throughput' => $getnetwork->getLanThroughput(),
                                'LastUpdate' => $getnetwork->getLastUpdate()->format('F j, Y, g:i a'),
                            );
        return new JsonResponse($network_json);
    }
    public function keyerror()
    {
        return new JsonResponse(array('error' => 'key is wrong.'));
    }
}