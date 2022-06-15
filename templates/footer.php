</td>

<td width="300px" class="sidebar">
    <div class="sidebarHeader">Меню</div>
    <ul>
        <li><a href="/www">Main page</a></li>
        <?php if(!$user) echo '<li><a href="/www/users/register">Register</a></li>'; ?>
        <?php if($user)if($user -> getRole() == "admin") echo '<li><a href="/www/add">Create new instance</a></li>'; ?>
        <!--<li><a href="/"></a></li>-->
    </ul>
</td>
</tr>
<tr>
    <td class="footer" colspan="2">&copy;2022 Burmistrov Ivan</td>
</tr>
</table>

</body>
</html>
