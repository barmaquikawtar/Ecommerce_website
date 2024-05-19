using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace WindowsFormsApp1.oop
{
    public class Admin
    {
        private int id;
        private string name;
        private string email;
        private string password;
        private DateTime created_at;

        public Admin(string name, string email, string password)
        {
            this.name = name;
            this.email = email;
            this.password = password;
        }
    }
}
