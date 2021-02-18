<template>
    <div class="typo">
        <h2 class="mt-3">Actor</h2>
        <table class="table">
            <tbody>
                <tr>
                    <td>
                        <code>john@doe.com</code>
                    </td>
                    <td>
                        Email from mbox.
                    </td>
                </tr>
                <tr>
                    <td>
                        <code>account:jdoe</code>
                    </td>
                    <td>
                        Account name.
                    </td>
                </tr>
                <tr>
                    <td>
                        <code>account:jdoe@http://lms.com</code>
                    </td>
                    <td>
                        Account name & homePage.
                    </td>
                </tr>
                <tr>
                    <td>
                        <h2>Verb</h2>
                    </td>
                    <td>
                    </td>
                </tr>
                <tr>
                    <td>
                        <code>completed</code>
                    </td>
                    <td>
                        Last segment(s) of the verb IRI.
                    </td>
                </tr>
                <tr>
                    <td>
                        <code>http://adlnet.gov/expapi/verbs/completed</code>
                    </td>
                    <td>
                        Full verb IRI.
                    </td>
                </tr>
                <tr>
                    <td>
                        <h2>Object</h2>
                    </td>
                    <td>
                    </td>
                </tr>
                <tr>
                    <td>
                        <code>course01</code>
                    </td>
                    <td>
                        Last segment(s) of the activity ID.
                    </td>
                </tr>
                <tr>
                    <td>
                        <code>http://lms.com/course01</code>
                    </td>
                    <td>
                        Full activity ID (best performances).
                    </td>
                </tr>
                <tr>
                    <td>
                        <code>name:xAPI</code>
                    </td>
                    <td>
                        Activity name: full or partial.
                    </td>
                </tr>
                <tr>
                    <td>
                        <code>type:cmi.interaction</code>
                    </td>
                    <td>
                        Activity type: last chunck.
                    </td>
                </tr>
                <tr>
                    <td>
                        <code>john@doe.com</code>
                    </td>
                    <td>
                        Agent or group: email from mbox.
                    </td>
                </tr>
                <tr>
                    <td>
                        <code>account:jdoe</code>
                    </td>
                    <td>
                        Agent or group: account name (and homePage).
                    </td>
                </tr>
                <tr>
                    <td>
                        <h2>Context</h2>
                    </td>
                    <td>
                    </td>
                </tr>
                <tr>
                    <td>
                        <code>http://lms.com/course01</code>
                    </td>
                    <td>
                        Context activity: full ID.
                    </td>
                </tr>
                <tr>
                    <td>
                        <code>parent:http://lms.com/course01</code>
                    </td>
                    <td>
                        Parent activity: full ID.
                    </td>
                </tr>
                <tr>
                    <td>
                        <code>grouping:http://lms.com/group01</code>
                    </td>
                    <td>
                        Grouping activity: full ID.
                    </td>
                </tr>
                <tr>
                    <td>
                        <code>category:http://lms.com/cat01</code>
                    </td>
                    <td>
                        Category activity: full ID.
                    </td>
                </tr>
                <tr>
                    <td>
                        <code>profile:cmi5</code>
                    </td>
                    <td>
                        Last chunk of the profile ID.
                    </td>
                </tr>
                <tr>
                    <td>
                        <code>john@doe.com</code>
                    </td>
                    <td>
                        Instructor or team: email from mbox.
                    </td>
                </tr>
                <tr>
                    <td>
                        <code>account:jdoe</code>
                    </td>
                    <td>
                        Instructor or team: account name (and homePage).
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <h2>From / To</h2>
                        <p>
                            The <strong>from</strong> value is inclusive. 
                            The <strong>to</strong> value is exclusive (i.e. before). 
                        </p>
                    </td>
                    <td>
                    </td>
                </tr>
                <tr>
                    <td>
                        <code>2020</code>
                    </td>
                    <td>
                        Year.
                    </td>
                </tr>
                <tr>
                    <td>
                        <code>2020-12</code>
                    </td>
                    <td>
                        Month.
                    </td>
                </tr>
                <tr>
                    <td>
                        <code>2020-12-31</code>
                    </td>
                    <td>
                        Day.
                    </td>
                </tr>
                <tr>
                    <td>
                        <code>2020-12-31 14:00</code>
                    </td>
                    <td>
                        Hour.
                    </td>
                </tr>
                <tr>
                    <td>
                        <code>2020-12-31 14:30:12</code>
                    </td>
                    <td>
                        Second.
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
    }
</script>

<style scoped>

    .table > tbody > tr > td {
        padding: 6px 7px;
    }
    
</style>