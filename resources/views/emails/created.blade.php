<h4>Dear Concern,</h4>
<p>
    New case created by <?php echo organization_name_from_user_id($litigation->created_by_id) ?>
</p>
<p>
    Here is the basic information of rescue.
</p>
<p>
<table>
    <tr>
        <td><strong>Name during rescue</strong></td>
        <td><?php echo $litigation->name_during_rescue; ?></td>
    </tr>
    <tr>
        <td><strong>Rescued From</strong></td>
        <td><?php echo $litigation->rescued_from_address; ?></td>
    </tr>
    <tr>
        <td><strong>Rescued By</strong></td>
        <td><?php echo $litigation->rescued_by; ?></td>
    </tr>
    <tr>
        <td><strong>Gender</strong></td>
        <td><?php echo $litigation->sex == 'F' ? 'Female': 'Male' ; ?></td>
    </tr>
    <tr>
        <td><strong>Case ID</strong></td>
        <td><?php echo $case_id; ?></a></td>
    </tr>
</table>

</p>
<p>
    Please click the link <a href="<?php echo url('/cases/'.$litigation->id.'?tid=9'); ?>"><?php echo  url('/cases/'.$litigation->id.'?tid=9');?> </a> to see the case.
</p>
<p>
    Thanks<br>
    RIMS Team
</p>>