using MySql.Data.MySqlClient;
using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace Biblio
{
    public partial class test : Form
    {
        MySqlConnection conn;
        string myConnectionString = "server=localhost;uid=root;pwd=;database=biblio";
        MySqlCommand cmd;
        MySqlDataReader dr;
        private int selected_id;
        public test()
        {
            InitializeComponent();
        }

        private void test_Load(object sender, EventArgs e)
        {
            try
            {
                conn = new MySqlConnection();
                conn.ConnectionString = myConnectionString;
                conn.Open();

                dataGridView3.DataSource = null;
                ////disponible ouvrage
                MySqlDataAdapter adapter3 = new MySqlDataAdapter("SELECT id,name,type,auteur,editeur,numero FROM `ouvrage`"
                 , conn);
                DataTable dt3 = new DataTable();
                adapter3.Fill(dt3);
                dataGridView3.DataSource = dt3;
                dataGridView3.Columns[0].HeaderText = "Id";
                dataGridView3.Columns[1].HeaderText = "Nom";
                dataGridView3.Columns[2].HeaderText = "Type";
                dataGridView3.Columns[3].HeaderText = "Auteur";
                dataGridView3.Columns[4].HeaderText = "Editeur";
                dataGridView3.Columns[5].HeaderText = "Numero";
                conn.Close();
            }
            catch (MySql.Data.MySqlClient.MySqlException ex)
            {
                MessageBox.Show(ex.Message);
            }
        }

        private void guna2Button1_Click(object sender, EventArgs e)
        {
            guna2MessageDialog1.Show();

        }
    }
}
