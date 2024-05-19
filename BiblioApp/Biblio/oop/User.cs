using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace WindowsFormsApp1.oop
{
    public class User
    {
        private int id;
        private string name;
        private string cin;
        private string email;
        private string phone;
        private DateTime created_at;

        public User(string name, string cin, string email, string phone)
        {
            this.name = name;
            this.cin = cin;
            this.email = email;
            this.phone = phone;
        }

        public String getname()
        {
            return name;
        }

       

    }
}
