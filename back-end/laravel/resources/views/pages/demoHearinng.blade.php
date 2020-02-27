@extends('layouts/app')

@section('content')
<style type="text/css">
      
    .case_details_table , tbody , tr , td ,th{
        border:1px solid #555;
        padding: 10px;
        background-color: #E9ECEF;
    }
    
    .table
    {
      margin-left: 10px;
    }
    .h2class {
        font-size: 1.1em;
        font-weight: normal;
        padding-top: -10px;
        margin-bottom: 10px;
    }
    .container
    {
      margin-top: 10px;
      margin-bottom:10px;
    }
    .button {
              background-color: #008CBA;
                border: none;
                color: white;
                padding: 15px 32px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 17px;
                margin: 1rem;
                margin:center;
                cursor: pointer;
                -webkit-transition-duration: 0.4s; /* Safari */
                transition-duration: 0.4s;
                align-items: center;
              }
              .button2:hover {
                box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
              }
    
        </style>
     
            <!-- Navigation -->
      
    
        <!-- Navigation -->
          <br>  
        
           
    
        <div class="container">
            <br> 
            <h2 class=" text-bold m-0 font-weight-normal">Hearing Details<span class="float-right"></span><a href="1.html"><button type="button" class="button button2  float-md-right">Back</button></a><button class="button button2 float-md-right " data-toggle="modal" data-target="#update_status">Update Details</button></h2>
            <br>
            <table width="100%" class="case_details_table" style="font-size:1em;">
              <tbody>
                
                
                <tr>
                  
                    <td><label><strong>Hearing entry</strong></label></td>
                    <td colspan="4"><label><strong>1</strong></label></td>
                  
                </tr>
                <tr>
                   
                  <td><label><strong>Starting date</strong></label></td>
                  <td colspan="4"><label><strong>10/21/2120</strong></label></td>
                
              </tr>
              <tr>
                   
                <td><label><strong>ending date</strong></label></td>
                <td colspan="4"><label><strong>10/21/2120</strong></label></td>
              
            </tr>
              <tr>
                   
                <td><label><strong>Purpose of Hearing</strong></label></td>
                <td colspan="4"><label><strong>to file emmotion 100 words</strong></label></td>
              
            </tr>
            <tr>
                   
                <td><label><strong>In the court of </strong></label></td>
                <td colspan="4"><label><strong>vgec</strong></label></td>
              
            </tr>
            <tr>
                   
                <td><label><strong>Judge</strong></label></td>
                <td colspan="4"><label><strong>i am yas patel from vgec</strong></label></td>
              
            </tr>
            <tr>
                   
                <td><label><strong>Judgement</strong></label></td>
                <td colspan="4"><label><strong>next hearing set</strong></label></td>
              
            </tr>
            <tr>
                   
                <td><label><strong>Comments</strong></label></td>
                <td colspan="4"><label><strong>acused member was absent</strong></label></td>
              
            </tr>
            <tr>
                   
                <td><label><strong>next hearing date</strong></label></td>
                <td colspan="4"><label><strong>10/21/2120</strong></label></td>
              
            </tr>
            <tr>
                   
                <td><label><strong>Next Hearing purpose</strong></label></td>
                <td colspan="4"><label><strong>i am yas patel from vgec</strong></label></td>
              
            </tr>
            <tr>
                   
                <td><label><strong>Description</strong></label></td>
                <td colspan="4"><label><strong>i am yas patel from vgec</strong></label></td>
              
            </tr>
            
            
              </tbody>
            </table>
            <br>
        
          
              
    
    
    
    </div>
                  
@endsection
